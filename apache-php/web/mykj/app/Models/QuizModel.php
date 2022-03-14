<?php


namespace App\Models;

//һ����۲���һ�����״̬�������۲����(Subject)�����仯��ʱ�����ģʽ��õ�֪ͨ��
use App\Event\Supplement\SupplementObserver;
use App\Event\Supplement\SupplementSubject;

//��������
class QuizModel
{
    public $mysql;
    public $Subject;

    function __construct(){
        $this->mysql = app('db');
        $this->Subject = new SupplementSubject($this);//ʵ�������۲���
        $this->Subject->attach( new SupplementObserver() );//ע��۲��ߣ�����������
    }


    //������������$quzi,$mobile,$newstime,$imgs,$uid������Ϊ����
    function add($quzi,$mobile,$newstime,$imgs,$uid) {

        //���������ֹ�Զ��ύ
        //$this->mysql->autocommit(0);

        $sql = 'INSERT INTO pre_quiz (quiz,mobile,newstime,imgs,uid) VALUES (?,?,?,?,?)';

        $smtm = $this->mysql->prepare($sql);

        if(!$smtm){
            echo '�������⣬�������';
            dd( $this->mysql->error);
        }

        $smtm->bind_param('siisi',$quzi,$mobile,$newstime,$imgs,$uid);

        $result = $smtm->execute();

        if(!$result){
            dd($smtm->error_list);
        }

        $id = $smtm->insert_id;

        $smtm->close();
        return $id;
    }

    //
    function getQuziByUid($uid){

        $sql = 'SELECT id,quiz,newstime FROM pre_quiz WHERE uid=?';
        $stmt = $this->mysql->prepare($sql);
        if(!$stmt){
            echo '��ѯ���������';
            dd( $this->mysql->error);
        }
        $stmt->bind_param('i',$uid);
        $stmt->bind_result($id,$quiz,$newstime);
        $stmt->execute();

        $rows = [];
        while($stmt->fetch()){

            array_push($rows, ['id'=>$id,'quiz'=>$quiz,'newstime'=>$newstime]);
        }

        $stmt->free_result();
        $stmt->close();
        return $rows;
    }

    function getQuziById($uid){

        $sql = 'SELECT id,quiz,newstime,uid,imgs FROM pre_quiz WHERE id=?';
        $stmt = $this->mysql->prepare($sql);
        if(!$stmt){
            echo '��ѯ���������';
            dd( $this->mysql->error);
        }
        $stmt->bind_param('i',$uid);
        $stmt->bind_result($id,$quiz,$newstime,$uid,$imgs);
        $stmt->execute();

        $row = [];
        while($stmt->fetch()){

            $row = ['id'=>$id,'quiz'=>$quiz,'newstime'=>$newstime,'uid'=>$uid,'imgs'=>$imgs];
        }

        $stmt->free_result();
        $stmt->close();
        return $row;
    }

    function getQuziByStatus($status = 0){

        $sql = 'SELECT id,quiz,newstime FROM pre_quiz WHERE status=?';
        $stmt = $this->mysql->prepare($sql);
        if(!$stmt){
            echo '��ѯ���������';
            dd( $this->mysql->error);
        }
        $stmt->bind_param('i',$status);
        $stmt->bind_result($id,$quiz,$newstime);
        $stmt->execute();

        $rows = [];
        while($stmt->fetch()){

            array_push($rows, ['id'=>$id,'quiz'=>$quiz,'newstime'=>$newstime]);
        }

        $stmt->free_result();
        $stmt->close();
        return $rows;
    }
}