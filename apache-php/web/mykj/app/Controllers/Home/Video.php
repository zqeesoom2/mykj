<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/7/4 0004
 * Time: ���� 5:20
 */

namespace App\Controllers\Home;

//�ϴ���Ƶ
class Video
{
    public function Index(){

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && is_uploaded_file($_FILES['video']['tmp_name'][0])) {
            $temp = $files = []; $i = 0;
            foreach ($_FILES['video'] as $key => $arrImg) {

                foreach ($arrImg as $k =>  $value){
                    $temp = [$key=>$value];
                    //upFile($fileimg,true);
                    if($i==0){
                        $files[] = $temp;
                    }else{
                        $files[$k] += $temp;
                    }
                }
                $i++;

            }

            $html = '';
            foreach($files as $file){
                $url = upVideo($file);
                echo '�ϴ��ɹ���<br/><a href=http://'.HOST.$url.'>http://'.HOST.$url.'</a>';

            }

        }else if(isset($_POST['img'])&&$_POST['img']==1){

            return (new Common())->UploadImgs();
        }
        else{
             include 'Home/Video.php';
        }



    }
}