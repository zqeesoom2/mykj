<?php
namespace App\Controllers\Home;
use App\Controllers\Controller;
use WeiXin\token\Jsapi_ticket;
use App\Models\QuizModel;

/** 控制器类名、方法名首字母必须大写 */
class Home extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function Index(){

    // dd('http://'.HOST.$_SERVER['REQUEST_URI']);
     $jssdk = new Jsapi_ticket();

     //ajax请求， 前台提交提问
     if($_SERVER['REQUEST_METHOD'] == 'POST'){

         $quiz = $this->arrPost['quiz'];

         $mobile = $this->arrPost['mobile'];
         $imgs = 0;
         //logs($this->arrPost);
         if(isset($this->arrPost['media_ids'])){
             $imgs = '';
             foreach ($this->arrPost['media_ids'] as $val) {
                 //根据微信JS接口上传了图片,会返回上面写的images.serverId（即media_id），填在下面即可
                 $str = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$jssdk->access_token.'&media_id='.$val;
                 //获取微信“获取临时素材”接口返回来的内容（即刚上传的图片）
                 $a = file_get_contents($str);

                 //自动创建年/月格式的目录
                 $format = date('Y/m',TIME);

                 $dir = mk_dir(BASEDIR.'/cmd/static/upload/image/'.$format);
                 $savename = randName().'.jpg';
                 //以读写方式打开一个文件
                 $resource = fopen($dir.'/'.$savename , 'w+');
                 //将图片内容写入上述新建的文件
                 fwrite($resource, $a);
                 //关闭资源
                 fclose($resource);

                 $imgs .= '//'.HOST.'/static/upload/image/'.$format.'/'.$savename.'|';
             }

         }
         $uid = $_SESSION['uid'];
         $Quiz = new QuizModel();
         $id = $Quiz->add($quiz,$mobile,TIME,$imgs,$uid);

         if($id>0){
             $Quiz->Subject->SupplementNotify($uid,$id);
             return 'OK';
         }


     }

     include BASEDIR . '/cmd/Home/Index.php';

    die();
     //echo "首页".PHP_EOL;
     /*PHP 中换行可以用 PHP_EOL 来替代，以提高代码的源代码级可移植性：
        unix系列用 \n
        windows系列用 \r\n
        mac用 \r*/
    // dd(__METHOD__);// 值： App\Controllers\Home::index

  //    echo $user->uid.":".$user->username;

    $mysqli =  app('db');

    // $stmt = $mysqli->prepare('set names gbk');
     //$stmt->execute();

/*INSERT INTO pre_session (sid,update_time,ip,`data`) VALUES ('ubtboa2t633l4opano39bg8m9l',1618552014,'172.100.100.80','CODE|s:8:"喜宁路鹅"')
*/
     $stmt = $mysqli->prepare('select `ip`,`update_time`,`data` from pre_session where sid = ?');
     $stmt->bind_param('i',$id);
     $stmt->bind_result($ip,$update_time,$data);
     $id = 'lgc2fdrumned00tc37l1uvsqpn';
     $stmt->execute();
     $stmt->store_result();
     while($stmt->fetch()){
         echo $ip.'> update_time:'.$update_time.'>data:'.$data;
     }
    echo '总记录数：'.$stmt->num_rows.PHP_EOL; dd($_SESSION);
     $stmt->free_result();
     $stmt->close();


 }



 //将cmd/ght下面的目录文件转成gbk
    //http://bbs.discuz.com/Home/gbk.html?dir=ght
 function gbk(){
     require __DIR__ . '/../Helpers/utf8-gbk.php';

     $dir = $_GET['dir'];
     $baseDir = dirname(dirname(__DIR__));
     $dir =  $baseDir.'/cmd/'.$dir;

     checkdir($dir);

 }

 //管道实验
 function Yc(){
     echo '<pre>';
     $array = [
         'Request', //先包第一层
         'Cookie',//再包第二层
         'Session'//最后包第三层
     ];

//先把洋葱包好
     $pipe = array_reduce($array, function ($resule, $val){

         return function() use ($resule, $val) {
             echo $val.'前置->';
             //$resule是执行后的结果（这里的执行结果是一个闭包返回），再次传给下次调用的闭包,循环传入
             $s =   $resule();
             echo $val.'后置->';
             return $s;
             // echo $y. '->' .  $r. ' <br>';
             // return  $return = $y. "-> ".$r;
         }
             ;

     },function(){ echo '我是控制器->';
         return  '控制器 return';
     }
     );


     print_r($pipe);
     echo $pipe();
     //打印结果 ：
    /* Closure Object
(
    [static] => Array
        (
            [resule] => Closure Object
                (
                    [static] => Array
                        (
                            [resule] => Closure Object
                                (
                                    [static] => Array
                                        (
                                            [resule] => Closure Object
                                                (
                                                    [this] => App\Controllers\Home\Home Object
                                                        (
                                                        )

                                                )

                                            [val] => Request
                                        )

                                    [this] => App\Controllers\Home\Home Object
                                        (
                                        )

                                )

                            [val] => Cookie
                        )

                    [this] => App\Controllers\Home\Home Object
                        (
                        )

                )

            [val] => Session
        )

    [this] => App\Controllers\Home\Home Object
        (
        )

)
Session前置->Cookie前置->Request前置->我是控制器->Request后置->Cookie后置->Session后置->控制器 return*/
 }
}