<?php
namespace App\Controllers\Home;
use App\Controllers\Controller;
use WeiXin\token\Jsapi_ticket;
use App\Models\QuizModel;

/** ����������������������ĸ�����д */
class Home extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function Index(){

    // dd('http://'.HOST.$_SERVER['REQUEST_URI']);
     $jssdk = new Jsapi_ticket();

     //ajax���� ǰ̨�ύ����
     if($_SERVER['REQUEST_METHOD'] == 'POST'){

         $quiz = $this->arrPost['quiz'];

         $mobile = $this->arrPost['mobile'];
         $imgs = 0;
         //logs($this->arrPost);
         if(isset($this->arrPost['media_ids'])){
             $imgs = '';
             foreach ($this->arrPost['media_ids'] as $val) {
                 //����΢��JS�ӿ��ϴ���ͼƬ,�᷵������д��images.serverId����media_id�����������漴��
                 $str = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$jssdk->access_token.'&media_id='.$val;
                 //��ȡ΢�š���ȡ��ʱ�زġ��ӿڷ����������ݣ������ϴ���ͼƬ��
                 $a = file_get_contents($str);

                 //�Զ�������/�¸�ʽ��Ŀ¼
                 $format = date('Y/m',TIME);

                 $dir = mk_dir(BASEDIR.'/cmd/static/upload/image/'.$format);
                 $savename = randName().'.jpg';
                 //�Զ�д��ʽ��һ���ļ�
                 $resource = fopen($dir.'/'.$savename , 'w+');
                 //��ͼƬ����д�������½����ļ�
                 fwrite($resource, $a);
                 //�ر���Դ
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
     //echo "��ҳ".PHP_EOL;
     /*PHP �л��п����� PHP_EOL �����������ߴ����Դ���뼶����ֲ�ԣ�
        unixϵ���� \n
        windowsϵ���� \r\n
        mac�� \r*/
    // dd(__METHOD__);// ֵ�� App\Controllers\Home::index

  //    echo $user->uid.":".$user->username;

    $mysqli =  app('db');

    // $stmt = $mysqli->prepare('set names gbk');
     //$stmt->execute();

/*INSERT INTO pre_session (sid,update_time,ip,`data`) VALUES ('ubtboa2t633l4opano39bg8m9l',1618552014,'172.100.100.80','CODE|s:8:"ϲ��·��"')
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
    echo '�ܼ�¼����'.$stmt->num_rows.PHP_EOL; dd($_SESSION);
     $stmt->free_result();
     $stmt->close();


 }



 //��cmd/ght�����Ŀ¼�ļ�ת��gbk
    //http://bbs.discuz.com/Home/gbk.html?dir=ght
 function gbk(){
     require __DIR__ . '/../Helpers/utf8-gbk.php';

     $dir = $_GET['dir'];
     $baseDir = dirname(dirname(__DIR__));
     $dir =  $baseDir.'/cmd/'.$dir;

     checkdir($dir);

 }

 //�ܵ�ʵ��
 function Yc(){
     echo '<pre>';
     $array = [
         'Request', //�Ȱ���һ��
         'Cookie',//�ٰ��ڶ���
         'Session'//����������
     ];

//�Ȱ���а���
     $pipe = array_reduce($array, function ($resule, $val){

         return function() use ($resule, $val) {
             echo $val.'ǰ��->';
             //$resule��ִ�к�Ľ���������ִ�н����һ���հ����أ����ٴδ����´ε��õıհ�,ѭ������
             $s =   $resule();
             echo $val.'����->';
             return $s;
             // echo $y. '->' .  $r. ' <br>';
             // return  $return = $y. "-> ".$r;
         }
             ;

     },function(){ echo '���ǿ�����->';
         return  '������ return';
     }
     );


     print_r($pipe);
     echo $pipe();
     //��ӡ��� ��
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
Sessionǰ��->Cookieǰ��->Requestǰ��->���ǿ�����->Request����->Cookie����->Session����->������ return*/
 }
}