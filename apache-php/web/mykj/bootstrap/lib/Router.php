<?php

class Router
{
    /** @var string ������ */
    public $controller = 'Home';
    /** @var string ���� */
    public $action = 'Index';

    /** @var string Ĭ��ǰ̨Ŀ¼*/
    public $Catalogue = 'Home';

    function __construct($Catalogue,$controller,$action){
        $this->Catalogue = $Catalogue;
        $this->controller = $controller;
        $this->action = $action;

       $this->parser();
    }

    /** ����URL/Cli·��:����������������������ĸ�����д
        ���ʸ�ʽ��http://****.com/Home/Index �� index.php Home Index
     *   ʵ�ֲ���:
            ��index.php���ص�,��Ҫ�õ�URL��д,������.htaccess,��apache��д��,��nginx����д��
            ��ȡ��home��index
            ��������,���������Ȳ�����.
            ֧��Ĭ�Ͽ������ͷ���
     * ֱ�ӹ涨�������ͷ�����������ĸ��д�������ͻ�����ܵĻ���������Щת����
     */
    function parser(){

            //nginx������������/index.php$uri?$query_string ����·�������һ���ʺ�
            if(strpos($this->controller,'?')){
                @list($this->controller) = explode('?',$this->controller);
            }

            //idnex2.html?id=2 �� IN2?id=1 ,������Ĳ������ù�
            if(strpos($this->action,'.html')) {
                @list($this->action, $extendName) = explode('.', $this->action);

            }else{
                //���URL��׺����html?��,ͳһ����Idnex
                $this->action = 'Index';
            }

            //ajax
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
               // echo 'ajax';exit();

                //�������Ļ���
              //$Controller =  new \App\Controllers\Controller();

             // $Controller->PostJosnToArr();
            }
            //POST
            else if (!empty($_POST)) {
                //return 'POST';
            }
            //GET
            else {
                //return 'GET';


            }

            if($this->Catalogue=='@php?' ||$this->Catalogue=='@php?no=1'){  //����Ǵ�����ֱ�ӷ���
                $this->setDefaultRouter('Home');
            }

            //�жϿ������治���� ��ע���ļ��������������URL����Ŀ��������֣�һ��
            if(!is_file(BASEDIR.'/app/Controllers/'.$this->Catalogue.'/'.$this->controller.'.php')){
                $this->setDefaultRouter($this->Catalogue);
            }

            //�����̨�Ķ�������֤Ȩ��
            if ($this->controller == 'Mykj' && $this->action !='Login'){

                // echo $this->controller;exit();
                //echo $this->action.PHP_EOL;       //master: 1��������Ա��3��ͨ����Ա
                if ( !isset($_SESSION['isLogin']) || $_SESSION["master"]!=1 && $_SESSION["master"]!=3 ){
                    //Failed to launch ��xxxxxx�� because the scheme does not have. ��ʾû��дͷЭ��
                    header('Location:http://'.$_SERVER['HTTP_HOST'].'/Mykj/Login.html');
                    die();
                }

            }

            //�ҵ������ռ����
            $controllerClass = 'App\Controllers\\'.$this->Catalogue.'\\'.$this->controller;
            $action =  $this->action;

            $controllerClass = new $controllerClass();

            if(!method_exists($controllerClass,$action)){
               // exit('δ���巽��:'.$action);
                $action = 'Index';
            }

            //$this->set();

            echo $controllerClass->$action();

    }

    /*
     * $Catalogue ǰ̨���̨
     */
    public function setDefaultRouter ($Catalogue){
        if($Catalogue == 'Home'){
            $this->Catalogue ='Home';
            $this->controller = 'Home';
            $this->action = 'Index';
        }else{
            $this->controller = 'Mykj';
            $this->action = 'Login';
        }

    }

    //����һЩȫ�ֲ���
    public function set(){




    }






}