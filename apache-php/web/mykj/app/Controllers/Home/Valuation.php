<?php


namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Models\ValuationModel;


//对咨询和顾问的评价
class Valuation extends Controller
{
    public  $valuat;

    function __construct()
    {
        parent::__construct();
        $this->valuat =  new ValuationModel();
    }

    //添加一条评价
    function Add(){

        //查看存不存在评价
        if ($this->isEvaluation()) {
            $sql = 'UPDATE  pre_valuation SET valuation=?,newstime=?,platform=? WHERE quizId=? AND uid=? AND byuid=? ;';
            $arr = $this->valuat->SqlPrepareAndExecute( $sql, 'sisiii',$this->arrPost['valuation'],TIME,$this->arrPost['platform'],$this->arrPost['qid'],$this->arrPost['uid'],$this->arrPost['byuid']);
            if(!$arr['error']){
                return 'OK';
            }

        }else{

            $id = $this->valuat->Add($this->arrPost['uid'],$this->arrPost['byuid'],$this->arrPost['valuation'],TIME,$this->arrPost['qid'],$this->arrPost['platform']);

            if($id){
                return 'OK';
            }
        }

    }

    //对某个顾问的点赞, byuid被评价的用户 ,  uid用户ID , qid咨询ID
    function ThumbsUp(){

            //查看存不存在评价
            if ($this->isEvaluation()) {
                $sql = 'UPDATE pre_valuation  SET `like`=? WHERE quizId=? AND uid=? AND byuid=? ';

                $arr = $this->valuat->SqlPrepareAndExecute( $sql, 'iiii',1,$this->arrPost['qid'],$this->arrPost['uid'],$this->arrPost['byuid']);

            }else{
                $sql = 'INSERT INTO pre_valuation (uid,byuid,newstime,quizId,`like`) VALUES (?,?,?,?,?)';

                $arr = $this->valuat->SqlPrepareAndExecute( $sql, 'iiiii',$this->arrPost['uid'],$this->arrPost['byuid'],TIME,$this->arrPost['qid'],1);

            }

            if(!$arr['error']){
                return 'OK';
            }

    }

    //对某个顾问的中标
    function Winning(){

        //查看存不存在评价
        if ($this->isEvaluation()) {
            $sql = 'UPDATE pre_valuation  SET `win`=? WHERE quizId=? AND uid=? AND byuid=? ';

            $arr = $this->valuat->SqlPrepareAndExecute( $sql, 'iiii',1,$this->arrPost['qid'],$this->arrPost['uid'],$this->arrPost['byuid']);

        }else{
            $sql = 'INSERT INTO pre_valuation (uid,byuid,newstime,quizId,`win`) VALUES (?,?,?,?,?)';

            $arr = $this->valuat->SqlPrepareAndExecute( $sql, 'iiiii',$this->arrPost['uid'],$this->arrPost['byuid'],TIME,$this->arrPost['qid'],1);

        }

        if(!$arr['error']){
            return 'OK';
        }
    }

    function isEvaluation(){

        if( isset($this->arrPost['byuid']) && isset($this->arrPost['uid']) && isset($this->arrPost['qid']) ){
             $arr =  $this->valuat->getByIds($this->arrPost['qid'],$this->arrPost['uid'],$this->arrPost['byuid']);
             return $arr['id'];
        }

        exit('评价查询参数不存在');
    }


}