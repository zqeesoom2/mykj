<?php


namespace App\Models;


class ValuationModel extends Model
{
    public $mysql;
    function __construct(){
        $this->mysql = app('db');
    }

    //根据ID获取一条信息。
    function getById($qid){
        $sql = 'SELECT id,uid,byuid,star,valuation,newstime,win,`like` FROM pre_valuation WHERE quizId = ?';

        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            die('编译查询ID出错');
        }
        $smt->bind_param('i',$qid);

        $smt->bind_result($id,$uid,$byuid,$star,$valuation,$newstime,$win,$like);

        $smt->execute();

        $temp =[];

        if($smt->fetch()){

            $temp['id'] = $id;
            $temp['uid'] = $uid;
            $temp['byuid'] = $byuid;
            $temp['star'] = $star;
            $temp['valuation'] = $valuation;
            $temp['newstime'] = $newstime;
            $temp['win'] = $win;
            $temp['like'] = $like;
        }

        $smt->free_result();
        $smt->close();
        return $temp;
    }

    //添加一条评价咨询和律师
    function Add($uid,$byuid,$valuation,$newstime,$quizId,$platform){

        $sql = 'INSERT INTO pre_valuation (uid,byuid,valuation,newstime,quizId,platform) VALUES (?,?,?,?,?,?) ';
        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            dd($smt);
            die('评价编译失败');
        }

        $smt->bind_param('iisiis',$uid,$byuid,$valuation,$newstime,$quizId,$platform);

        $result = $smt->execute();

        if(!$result){
            print_r($smt->error_list);
            die('新增评价失败');
        }

        $id = $smt->insert_id;


        $smt->close();
        return $id;

    }

    //对某个被评价的顾问，谁评价的，评价的咨询ID是多少？
    function getByIds($qid,$uid,$byuid){

        $sql = 'SELECT id,win,`like`,valuation FROM pre_valuation WHERE quizId = ? AND uid = ? AND byuid = ?';

        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            die('编译查询ID出错');
        }
        $smt->bind_param('iii',$qid,$uid,$byuid);

        $smt->bind_result($id,$win,$like,$valuation);

        $smt->execute();

        $tid = [];

        if($smt->fetch()){

            $tid['id'] = $id;
            $tid['win'] = $win;
            $tid['like'] = $like;
            $tid['valuation'] = $valuation;

        }

        $smt->free_result();
        $smt->close();
        return $tid;

    }
}