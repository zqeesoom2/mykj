<?php


namespace App\Models;

use App\Event\Questing\QuestingSubject;
use App\Event\Questing\QuestingObserver;
//追问模型
class QuestingModel extends Model
{
    public $mysql;
    public $table = PREFIX.'questing';
    public $Subject;

    function __construct(){
        $this->mysql = app('db');
        $this->Subject = new QuestingSubject($this);
        $this->Subject->attach( new QuestingObserver() );
    }

    public function add($aid,$question,$imgs,$newstime){

        if(!is_numeric($aid)){
            return  ['error'=>1,'msg'=>'回答的ID不存在'];
        }

        $sql ='INSERT INTO '.$this->table.' (aid,question,imgs,newstime) VALUES (?,?,?,?)';

        return  $this->SqlPrepareAndExecute($sql,'issi',$aid,$question,$imgs,$newstime);
    }


    function getQuestionById($aid){

        $sql = 'SELECT question,imgs FROM '.$this->table.' WHERE aid=?';
        $stmt = $this->mysql->prepare($sql);
        if(!$stmt){
            echo '查询，编译出错';
            dd( $this->mysql->error);
        }
        $stmt->bind_param('i',$aid);
        $stmt->bind_result($question,$imgs);
        $stmt->execute();

        $rows = [];
        while($stmt->fetch()){

            $rows[] = ['question'=>$question,'imgs'=>$imgs];
        }

        $stmt->free_result();
        $stmt->close();
        return $rows;
    }
}