<?php
namespace App\Providers;


class Config
{
    protected $itmes = [];

    /**
     * ��ȡPHP�ļ����͵������ļ�
     * @return [type] [description]
     */
    public function phpParser($configPath)
    {
        // 1. �ҵ��ļ�
        // �˴������༶�����

       if(is_dir($configPath)){
           $files = scandir($configPath);//�г�ָ��·���е��ļ���Ŀ¼������

           if(count($files)){
               $data = null;
               // 2. ��ȡ�ļ���Ϣ
               foreach ($files as $key => $file) {
                   if ($file === '.' || $file === '..') {
                       continue;
                   }
                   // 2.1 ��ȡ�ļ���
                   $filename = \stristr($file, ".php", true);
                   // 2.2 ��ȡ�ļ���Ϣ
                   $data[$filename] = include $configPath."/".$file;
               }
               // 3. ���������
               $this->itmes = $data;
           }

           return $this;
       }

    }
    // key.key2.key3
    public function get($keys)
    {
        $data = $this->itmes;

        if($data){

            foreach (\explode('.', $keys) as $key => $value) {
                $data = $data[$value];
            }
        }

        return $data;
    }

    public function all()
    {
        return $this->itmes;
    }


}