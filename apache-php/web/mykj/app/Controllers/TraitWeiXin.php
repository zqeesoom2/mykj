<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/6/27 0027
 * Time: 下午 1:11
 */
namespace App\Controllers;



//前台提交的微信信息及图片处理
trait  TraitWeiXin
{
    public function handleImg(){

            $imgs = 0;
            //logs($this->arrPost);
            if(isset($this->arrPost['media_ids'])){
                 $imgs = '';

                foreach ($this->arrPost['media_ids'] as $key => $val) {
                    //根据微信JS接口上传了图片,会返回上面写的images.serverId（即media_id），填在下面即可
                    $str = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->jssdk->access_token.'&media_id='.$val;
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
            return  rtrim($imgs,'|');
    }
}