<?php


namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Controllers\TraitWeiXin;
use App\Models\QuestingModel;
use App\Models\QuizModel;
use App\Models\AnswerModel;
use App\Models\SupplementModel;
use App\Models\ValuationModel;
use WeiXin\token\Jsapi_ticket;



//咨询业务
class Consult extends Controller
{
    use TraitWeiXin;
    public $uid,$answer,$quiz,$jssdk,$supplement,$valuat;

    function __construct()
    {
        parent::__construct();
        $this->uid = $_SESSION['uid'];

        //获取问题
        $this->quiz = new QuizModel();

        //weixin jsDK
        $this->jssdk = new Jsapi_ticket();

        //获取回答
        $this->answer = new AnswerModel();

        //获取补充的问题
        $this->supplement = new SupplementModel();

        //获取追问
        $this->Questing = new QuestingModel();

        //获取评价
        $this->valuat =  new ValuationModel();
    }

    //某一个咨询的处理,律师和用户的咨询查看、追问，回答，补充问题都走这里
    public function Consult(){

        //咨询ID
        $id = $_GET['id'];

        if(is_numeric($id) ){

            //ajax请求， 前台提交顾问回答或用户追问
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $quiz = $this->arrPost['quiz'];//文本内容（可含顾问回答、用户追问、用户补充）

                //处理微信上传图片
                $imgs = $this->handleImg();

                if( !$_SESSION['master']){//普通会员

                    //添加补充问题
                   if(isset($this->arrPost['type']) && $this->arrPost['type']=='supplement') {
                       $resutl =  $this->supplement->add($id,$quiz,$this->arrPost['imgs']);
                       if($resutl['error']==0){
                            //给所有的顾问发送通知
                           $this->supplement->Subject->SupplementNotify($this->uid,$resutl['insert_id']);
                           return 'OK';
                       }

                    }
                    //添加追问
                    else{
                        $resutl =  $this->Questing->add($this->arrPost['aid'],$quiz,$imgs,TIME);

                        if($resutl['error']==0){
                            $this->Questing->Subject->QuestingNotify($this->uid,$this->arrPost['toUserid'],$resutl['insert_id']);
                            return 'OK';
                        }
                    }

                }else{ //顾问、管理员

                    //添加回答问题
                    $resutl = $this->answer->add($this->uid,$quiz,$id,TIME,$imgs);
                    if(isset($resutl['error'])){

                        //通过咨询ID，找到是谁咨询
                        $arr =  $this->quiz->getQuziById($id);

                        //通知用户有最新的回答消息
                        $this->answer->Subject->AnswerNotify($this->uid,$arr['uid'],$resutl['insert_id']);
                        return 'OK';
                    }else{

                        return 'error';
                    }

                }

            }
            //GET请求
            else{

                $UserModel =  new \App\Models\UserModel();
                //查出咨询ID
                $arr =  $this->quiz->getQuziById($id);

                //咨询是否过期
                  if($arr['newstime']+86400 >TIME ) $expire=0 ; else $expire=1;

                //查咨询补充的问题
                $arrSupplement = $this->supplement->getSupplementById($id);
                

                if( !$_SESSION['master']){//普通会员

                    //查出咨询ID对应所有的回答
                    $arrAnswer = $this->answer->getAnswerById($id);

                    //将所有的回答过滤出唯一的回答用户
                    $arrUsers = [];
                    foreach ($arrAnswer as $item){
                        if(empty($arrUsers) || !in_array($item['uid'],$arrUsers) ){
                            $arrUsers[] = $item['uid'];

                        }

                    }

                    include 'Home/consult.php';

                }else{ //顾问、管理员

                    //查出咨询ID对应顾问的回答
                    $arrAnswer = $this->answer->getAnswerById($id,$this->uid);


                   $Lawyer = $UserModel->getUserById($this->uid);

                   include 'Home/consult_lawyer.php';
                }
            }


        }


    }


    //查看提问记录,分别为我的提问记录、律师可以查看的提问记录
    public function SearchRecord(){

       $master =  $_SESSION['master'];

        if(isset($master)){

            if(!$master){//普通用户


                if (is_numeric( $this->uid)) {
                    $arr =  $this->quiz->getQuziByUid( $this->uid);

                }

            }else{
                $arr =  $this->quiz->getQuziByStatus();//进行中的
            }

            include 'Home/my-search-record.php';

        }

    }


}