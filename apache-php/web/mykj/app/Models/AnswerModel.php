<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/6/27 0027
 * Time: ���� 2:51
 */

namespace App\Models;

use App\Event\Answer\AnswerSubject;
use App\Event\Answer\AnswerObserver;
//�ش�ģ��
class AnswerModel extends Model
{
    public $mysql;
    public $Subject;

    function __construct(){
        $this->mysql = app('db');

        //���۲�
        $this->Subject = new AnswerSubject($this);

        //ʵ�ֹ۲��ߣ�֪ͨ�û�ҵ��
        $this->Subject->attach(new AnswerObserver());
    }

    public function add($uid,$answer,$qid,$newtime,$imgs){

        $sql ='INSERT INTO pre_answer (uid,answer,newstime,qid,imgs) VALUES (?,?,?,?,?)';

        return  $this->SqlPrepareAndExecute($sql,'isiis',$uid,$answer,$newtime,$qid,$imgs);
    }

    function getAnswerById($qid,$uid=0){

        if($uid){
            $sql = 'SELECT id,answer,newstime,uid,imgs FROM pre_answer WHERE qid=? AND uid = ?';
        }else{
            $sql = 'SELECT id,answer,newstime,uid,imgs FROM pre_answer WHERE qid=?';
        }


        $stmt = $this->mysql->prepare($sql);
        if(!$stmt){
            echo '��ѯ���������';
            dd( $this->mysql->error);
        }


        if($uid){
            $stmt->bind_param('ii',$qid,$uid);
        }else{
            $stmt->bind_param('i',$qid);
        }

        $stmt->bind_result($id,$answer,$newstime,$uid,$imgs);
        $stmt->execute();

        $rows = [];
        while($stmt->fetch()){

            $rows[] = ['id'=>$id,'answer'=>$answer,'newstime'=>$newstime,'uid'=>$uid,'imgs'=>$imgs];
        }

        $stmt->free_result();
        $stmt->close();
        return $rows;
    }
}