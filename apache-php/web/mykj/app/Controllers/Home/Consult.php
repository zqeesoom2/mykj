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



//��ѯҵ��
class Consult extends Controller
{
    use TraitWeiXin;
    public $uid,$answer,$quiz,$jssdk,$supplement,$valuat;

    function __construct()
    {
        parent::__construct();
        $this->uid = $_SESSION['uid'];

        //��ȡ����
        $this->quiz = new QuizModel();

        //weixin jsDK
        $this->jssdk = new Jsapi_ticket();

        //��ȡ�ش�
        $this->answer = new AnswerModel();

        //��ȡ���������
        $this->supplement = new SupplementModel();

        //��ȡ׷��
        $this->Questing = new QuestingModel();

        //��ȡ����
        $this->valuat =  new ValuationModel();
    }

    //ĳһ����ѯ�Ĵ���,��ʦ���û�����ѯ�鿴��׷�ʣ��ش𣬲������ⶼ������
    public function Consult(){

        //��ѯID
        $id = $_GET['id'];

        if(is_numeric($id) ){

            //ajax���� ǰ̨�ύ���ʻش���û�׷��
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $quiz = $this->arrPost['quiz'];//�ı����ݣ��ɺ����ʻش��û�׷�ʡ��û����䣩

                //����΢���ϴ�ͼƬ
                $imgs = $this->handleImg();

                if( !$_SESSION['master']){//��ͨ��Ա

                    //��Ӳ�������
                   if(isset($this->arrPost['type']) && $this->arrPost['type']=='supplement') {
                       $resutl =  $this->supplement->add($id,$quiz,$this->arrPost['imgs']);
                       if($resutl['error']==0){
                            //�����еĹ��ʷ���֪ͨ
                           $this->supplement->Subject->SupplementNotify($this->uid,$resutl['insert_id']);
                           return 'OK';
                       }

                    }
                    //���׷��
                    else{
                        $resutl =  $this->Questing->add($this->arrPost['aid'],$quiz,$imgs,TIME);

                        if($resutl['error']==0){
                            $this->Questing->Subject->QuestingNotify($this->uid,$this->arrPost['toUserid'],$resutl['insert_id']);
                            return 'OK';
                        }
                    }

                }else{ //���ʡ�����Ա

                    //��ӻش�����
                    $resutl = $this->answer->add($this->uid,$quiz,$id,TIME,$imgs);
                    if(isset($resutl['error'])){

                        //ͨ����ѯID���ҵ���˭��ѯ
                        $arr =  $this->quiz->getQuziById($id);

                        //֪ͨ�û������µĻش���Ϣ
                        $this->answer->Subject->AnswerNotify($this->uid,$arr['uid'],$resutl['insert_id']);
                        return 'OK';
                    }else{

                        return 'error';
                    }

                }

            }
            //GET����
            else{

                $UserModel =  new \App\Models\UserModel();
                //�����ѯID
                $arr =  $this->quiz->getQuziById($id);

                //��ѯ�Ƿ����
                  if($arr['newstime']+86400 >TIME ) $expire=0 ; else $expire=1;

                //����ѯ���������
                $arrSupplement = $this->supplement->getSupplementById($id);
                

                if( !$_SESSION['master']){//��ͨ��Ա

                    //�����ѯID��Ӧ���еĻش�
                    $arrAnswer = $this->answer->getAnswerById($id);

                    //�����еĻش���˳�Ψһ�Ļش��û�
                    $arrUsers = [];
                    foreach ($arrAnswer as $item){
                        if(empty($arrUsers) || !in_array($item['uid'],$arrUsers) ){
                            $arrUsers[] = $item['uid'];

                        }

                    }

                    include 'Home/consult.php';

                }else{ //���ʡ�����Ա

                    //�����ѯID��Ӧ���ʵĻش�
                    $arrAnswer = $this->answer->getAnswerById($id,$this->uid);


                   $Lawyer = $UserModel->getUserById($this->uid);

                   include 'Home/consult_lawyer.php';
                }
            }


        }


    }


    //�鿴���ʼ�¼,�ֱ�Ϊ�ҵ����ʼ�¼����ʦ���Բ鿴�����ʼ�¼
    public function SearchRecord(){

       $master =  $_SESSION['master'];

        if(isset($master)){

            if(!$master){//��ͨ�û�


                if (is_numeric( $this->uid)) {
                    $arr =  $this->quiz->getQuziByUid( $this->uid);

                }

            }else{
                $arr =  $this->quiz->getQuziByStatus();//�����е�
            }

            include 'Home/my-search-record.php';

        }

    }


}