<?php


namespace App\Controllers;


/** ����������������������ĸ�����д */
class Home
{
 function Index(){
     echo "��ҳ".PHP_EOL;
     /*PHP �л��п����� PHP_EOL �����������ߴ����Դ���뼶����ֲ�ԣ�
        unixϵ���� \n
        windowsϵ���� \r\n
        mac�� \r*/
    // dd(__METHOD__);// ֵ�� App\Controllers\Home::index

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
    echo '�ܼ�¼����'.$stmt->num_rows;
     $stmt->free_result();
     $stmt->close();


 }

 //װcmd/ght�����Ŀ¼�ļ�ת��gbk
    //http://bbs.discuz.com/Home/gbk.html?dir=ght
 function gbk(){
     require __DIR__.'/../Helpers/utf8-gbk.php';

     $dir = $_GET['dir'];
     $baseDir = dirname(dirname(__DIR__));
     $dir =  $baseDir.'/cmd/'.$dir;

     checkdir($dir);

 }
}