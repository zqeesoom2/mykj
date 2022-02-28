<?php


namespace App\Controllers;

//控制器-基类
class Controller
{
    protected $arrPost;

    function __construct()
    {

    //    echo '控制器基类'.PHP_EOL;
        if(isset($_POST['param']))
            $this->arrPost = $this->PostJosnToArr($_POST['param']);


    }

    function Index(){
        echo '控制器基类index'.PHP_EOL;
    }

    /**
     * 将前台提交的json数据转化为数组。
     * $str 源值
     * $need 是否对源值json转换arr
     * 返回数组
     */
    function PostJosnToArr($arrJson,$need = true){
        //+true的作用是变成数组，否则是json对象

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

    //将gbk 的编码转换成utf8 因为json必须都是utf-8格式。
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