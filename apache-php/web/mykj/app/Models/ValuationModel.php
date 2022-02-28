<?php


namespace App\Models;


class ValuationModel extends Model
{
    public $mysql;
    function __construct(){
        $this->mysql = app('db');
    }

    //����ID��ȡһ����Ϣ��
    function getById($qid){
        $sql = 'SELECT id,uid,byuid,star,valuation,newstime,win,`like` FROM pre_valuation WHERE quizId = ?';

        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            die('�����ѯID����');
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

    //���һ��������ѯ����ʦ
    function Add($uid,$byuid,$valuation,$newstime,$quizId,$platform){

        $sql = 'INSERT INTO pre_valuation (uid,byuid,valuation,newstime,quizId,platform) VALUES (?,?,?,?,?,?) ';
        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            dd($smt);
            die('���۱���ʧ��');
        }

        $smt->bind_param('iisiis',$uid,$byuid,$valuation,$newstime,$quizId,$platform);

        $result = $smt->execute();

        if(!$result){
            print_r($smt->error_list);
            die('��������ʧ��');
        }

        $id = $smt->insert_id;


        $smt->close();
        return $id;

    }

    //��ĳ�������۵Ĺ��ʣ�˭���۵ģ����۵���ѯID�Ƕ��٣�
    function getByIds($qid,$uid,$byuid){

        $sql = 'SELECT id,win,`like`,valuation FROM pre_valuation WHERE quizId = ? AND uid = ? AND byuid = ?';

        $smt = $this->mysql->prepare($sql);
        if(!$smt){
            die('�����ѯID����');
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