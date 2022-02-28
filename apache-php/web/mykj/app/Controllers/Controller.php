<?php


namespace App\Controllers;

//������-����
class Controller
{
    protected $arrPost;

    function __construct()
    {

    //    echo '����������'.PHP_EOL;
        if(isset($_POST['param']))
            $this->arrPost = $this->PostJosnToArr($_POST['param']);


    }

    function Index(){
        echo '����������index'.PHP_EOL;
    }

    /**
     * ��ǰ̨�ύ��json����ת��Ϊ���顣
     * $str Դֵ
     * $need �Ƿ��Դֵjsonת��arr
     * ��������
     */
    function PostJosnToArr($arrJson,$need = true){
        //+true�������Ǳ�����飬������json����

        if($need)  $arrJson = json_decode($arrJson,true);

        if(is_array($arrJson) && count($arrJson)){
            foreach ($arrJson as $k => $v) {
                if (is_array($v)){
                    $arrJson[$k] =  $this->PostJosnToArr($v,false);
                }else{

                    $arrJson[$k] =  iconv('utf-8','gbk',$v);

                }

            }

        }
        return $arrJson;
    }

    //��gbk �ı���ת����utf8 ��Ϊjson���붼��utf-8��ʽ��
    function ArrToUtf8($arr){

        if(is_array($arr)){
            foreach ($arr as $k => $v) {
                if (is_array($v)){
                    $arr[$k] =  $this->ArrToUtf8($v);
                }else{
                    $arr[$k] =  iconv('gbk','utf-8',$v);

                }

            }

        }
        return $arr;
    }

}