<?php


namespace App\Models;

use App\Event\Supplement\SupplementSubject;
use App\Event\Supplement\SupplementObserver;

//补充问题模型
class SupplementModel extends Model
{
    public $mysql;
    public $table = PREFIX.'supplement';
    public $Subject;

    function __construct(){
        $this->mysql = app('db');
        $this->Subject = new SupplementSubject($this);
        $this->Subject->attach( new SupplementObserver() );
    }

    public function add($quizId,$supplement,$imgs){

        $sql ='INSERT INTO '.$this->table.' (quizId,supplement,imgs) VALUES (?,?,?)';

        return  $this->SqlPrepareAndExecute($sql,'iss',$quizId,$supplement,$imgs);
    }


    function getSupplementById($qid){

        $sql = 'SELECT supplement,imgs FROM '.$this->table.' WHERE quizId=?';
        $stmt = $this->mysql->prepare($sql);
        if(!$stmt){
            echo '查询，编译出错';
            dd( $this->mysql->error);
        }
        $stmt->bind_param('i',$qid);
        $stmt->bind_result($supplement,$imgs);
        $stmt->execute();

        $rows = [];
        while($stmt->fetch()){

            $rows[] = ['supplement'=>$supplement,'imgs'=>$imgs];
        }

        $stmt->free_result();
        $stmt->close();
        return $rows;
    }

}