<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/6/27 0027
 * Time: ���� 1:11
 */
namespace App\Controllers;



//ǰ̨�ύ��΢����Ϣ��ͼƬ����
trait  TraitWeiXin
{
    public function handleImg(){

            $imgs = 0;
            //logs($this->arrPost);
            if(isset($this->arrPost['media_ids'])){
                 $imgs = '';

                foreach ($this->arrPost['media_ids'] as $key => $val) {
                    //����΢��JS�ӿ��ϴ���ͼƬ,�᷵������д��images.serverId����media_id�����������漴��
                    $str = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->jssdk->access_token.'&media_id='.$val;
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
            return  rtrim($imgs,'|');
    }
}