<?php


namespace App\Controllers\Home;

//公共组件类
class Common
{
    function UploadImgs(){

    //  dd( $_FILES['FileImgs']);
       /*打印信息
    array(5) {
  ["name"]=>
  array(2) {
    [0]=>
    string(5) "8.jpg"
    [1]=>
    string(5) "9.jpg"
  }
  ["type"]=>
  array(2) {
    [0]=>
    string(10) "image/jpeg"
    [1]=>
    string(10) "image/jpeg"
  }
  ["tmp_name"]=>
  array(2) {
    [0]=>
    string(14) "/tmp/phpQZQ38k"
    [1]=>
    string(14) "/tmp/php8eBm3C"
  }
  ["error"]=>
  array(2) {
    [0]=>
    int(0)
    [1]=>
    int(0)
  }
  ["size"]=>
  array(2) {
    [0]=>
    int(41796)
    [1]=>
    int(38211)
  }
}
*/

      if (is_uploaded_file($_FILES['FileImgs']['tmp_name'][0])) {
          $temp = $files = []; $i = 0;
          foreach ($_FILES['FileImgs'] as $key => $arrImg) {

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
              $imgurl = upFile($file,true,date('m',TIME));
              $imgurl = '//'.HOST.$imgurl;
              $html .='<li class="weui-uploader__file" style="background-image:url('.$imgurl.')"></li>';
          }

          return '<script>var upimg = parent.document.getElementById("preview");var html = upimg.innerHTML; html +=\''.$html.'\'; upimg.innerHTML=html;</script>';

      }

    }

}