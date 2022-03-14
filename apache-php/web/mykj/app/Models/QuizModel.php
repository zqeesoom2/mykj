<?php


namespace App\Models;

//一个类观察另一个类的状态，当被观察的类(Subject)发生变化的时候，这个模式会得到通知。
use App\Event\Supplement\SupplementObserver;
use App\Event\Supplement\SupplementSubject;

//提的问题表
class QuizModel
{
    public $mysql;
    public $Subject;

    function __construct(){
        $this->mysql = app('db');
        $this->Subject = new SupplementSubject($this);//实例化被观察者
        $this->Subject->attach( new SupplementObserver() );//注册观察者，用来处理动作
    }


    //传过来的数据$quzi,$mobile,$newstime,$imgs,$uid，接收为数组
    function add($quzi,$mobile,$newstime,$imgs,$uid) {

        //开启事物，禁止自动提交
        //$this->mysql->autocommit(0);

        $sql = 'INSERT INTO pre_quiz (quiz,mobile,newstime,imgs,uid) VALUES (?,?,?,?,?)';

        $smtm = $this->mysql->prepare($sql);

        if(!$smtm){
            echo '插入问题，编译出错';
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
            echo '查询，编译出错';
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
            echo '查询，编译出错';
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
            echo '查询，编译出错';
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