<?php
//��utf8�ļ�ת��gbk����
function checkdir($basedir){

    if ($dh = opendir($basedir)) {
        while ( ($file = readdir($dh) ) !== false ) {
                if ($file != '.' && $file !='..') {
                    if(!is_dir($basedir.'/'.$file)){
                        echo '�ļ�'.$basedir.'/'.$file.trans_gbk($basedir.'/'.$file).'<br>';
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

    //json_encode���ַ������б��롣��Ϊ�ú���ֻ�ܽ���uft8�����������gbk�Ļ����ͷ���Ϊnull
    if(json_encode($content) != 'null') {

        $rest = mb_convert_encoding($content,'gbk','utf-8');
        return rewrite($filename,$rest);

    }else{
        return 'δת��';
    }


}

function rewrite($filename,$data){
    list(,$exten) = explode('.',$filename);

    if (strripos($exten,'php')!==false || strripos($exten,'htm')!==false ||strripos($exten,'css')!==false ||strripos($exten,'js')!==false ||strripos($exten,'txt')!==false){
        $filenum = fopen($filename,'w');
        flock($filenum,LOCK_EX);//ȡ�ö�ռ������д��ĳ���)
        fwrite($filenum,$data);
        fclose($filenum);
        return '��ת��';
    }

}