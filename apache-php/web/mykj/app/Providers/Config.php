<?php
namespace App\Providers;


class Config
{
    protected $itmes = [];

    /**
     * 读取PHP文件类型的配置文件
     * @return [type] [description]
     */
    public function phpParser($configPath)
    {
        // 1. 找到文件
        // 此处跳过多级的情况

       if(is_dir($configPath)){
           $files = scandir($configPath);//列出指定路径中的文件和目录并返回

           if(count($files)){
               $data = null;
               // 2. 读取文件信息
               foreach ($files as $key => $file) {
                   if ($file === '.' || $file === '..') {
                       continue;
                   }
                   // 2.1 获取文件名
                   $filename = \stristr($file, ".php", true);
                   // 2.2 读取文件信息
                   $data[$filename] = include $configPath."/".$file;
               }
               // 3. 结果是数组
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