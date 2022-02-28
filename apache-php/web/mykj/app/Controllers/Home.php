<?php


namespace App\Controllers;


/** 控制器类名、方法名首字母必须大写 */
class Home
{
 function Index(){
     echo "首页".PHP_EOL;
     /*PHP 中换行可以用 PHP_EOL 来替代，以提高代码的源代码级可移植性：
        unix系列用 \n
        windows系列用 \r\n
        mac用 \r*/
    // dd(__METHOD__);// 值： App\Controllers\Home::index

  //    echo $user->uid.":".$user->username;

    $mysqli =  app('db');



    // $stmt = $mysqli->prepare('set names gbk');
     //$stmt->execute();


     $stmt = $mysqli->prepare('select `ip`,`update_time`,`data` from pre_session where sid = ?');
     $stmt->bind_param('i',$id);
     $stmt->bind_result($ip,$update_time,$data);
     $id = 1;
     $stmt->execute();
     $stmt->store_result();
     while($stmt->fetch()){
         echo $ip.'> update_time:'.$update_time.'>data:'.$data;
     }
    echo '总记录数：'.$stmt->num_rows;
     $stmt->free_result();
     $stmt->close();


 }

 //装cmd/ght下面的目录文件转成gbk
    //http://bbs.discuz.com/Home/gbk.html?dir=ght
 function gbk(){
     require __DIR__.'/../Helpers/utf8-gbk.php';

     $dir = $_GET['dir'];
     $baseDir = dirname(dirname(__DIR__));
     $dir =  $baseDir.'/cmd/'.$dir;

     checkdir($dir);

 }
}