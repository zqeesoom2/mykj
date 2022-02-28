<?php
//将utf8文件转换gbk编码
function checkdir($basedir){

    if ($dh = opendir($basedir)) {
        while ( ($file = readdir($dh) ) !== false ) {
                if ($file != '.' && $file !='..') {
                    if(!is_dir($basedir.'/'.$file)){
                        echo '文件'.$basedir.'/'.$file.trans_gbk($basedir.'/'.$file).'<br>';
                    }else{
                        $dirname = $basedir.'/'.$file;
                        checkdir($dirname);
                    }
                }
        }
        closedir($dh);
    }
}

function trans_gbk($filename){
    $content= file_get_contents($filename);

    //json_encode将字符串进行编码。因为该函数只能接受uft8，所以如果是gbk的话，就返回为null
    if(json_encode($content) != 'null') {

        $rest = mb_convert_encoding($content,'gbk','utf-8');
        return rewrite($filename,$rest);

    }else{
        return '未转换';
    }


}

function rewrite($filename,$data){
    list(,$exten) = explode('.',$filename);

    if (strripos($exten,'php')!==false || strripos($exten,'htm')!==false ||strripos($exten,'css')!==false ||strripos($exten,'js')!==false ||strripos($exten,'txt')!==false){
        $filenum = fopen($filename,'w');
        flock($filenum,LOCK_EX);//取得独占锁定（写入的程序)
        fwrite($filenum,$data);
        fclose($filenum);
        return '已转换';
    }

}