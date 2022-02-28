<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/6/14 0014
 * Time: 下午 1:14
 */

namespace App\Models;


class Model
{

    /** 没有结果集的预编译
     * @param $sql
     * @param $types  字符串
     * @param mixed ...$param
     * @return int
     * @throws \ReflectionException
     */
    function SqlPrepareAndExecute( $sql, $types, ...$param){

        $stmt = $this->mysql->prepare($sql);
      //  echo $sql;
        if(!$stmt){
            echo $sql;
           dd($this->mysql->error);
            die('修改编译出错');
        }

        // $data = array("sssiiisssi",$param[0],$param[1],$param[2],$param[3],$param[4],$param[5],$param[6],$param[7],$param[8],$param[9]);
        $data = array_merge((array) $types, $param);

        $ref = new \ReflectionClass('mysqli_stmt');

        $method = $ref->getMethod("bind_param");

        @$method->invokeArgs($stmt,$data);

        if ($stmt) {
            if($stmt->execute()){
                $arr = ['error'=>0,'insert_id'=>$stmt->insert_id,'affected_rows'=>$stmt->affected_rows];
                $stmt->close();
                return $arr;
            }
            else{
                print_r($stmt->error_list);
                $stmt->close();
                return ['error'=>1,'msg'=>'修改失败'];
            }

        }
    }



    function delete($id){
        $sql = 'UPDATE  '.$this->table.'  SET softDelete = 1,deleteTime= '.TIME.' WHERE id = ?';

        $smt = $this->mysql->prepare($sql);

        if(!$smt){
            echo $sql;
            die('删除新闻编译出错');
        }

        $smt->bind_param('i',$id);

        if($smt->execute()) {
            $smt->close();
            return 0;
        }else{
            print_r($smt->error_list);
            return 1;//失败
        }

    }
    //获取总计录数

    /**
     * @param $whereStatus
     * @param $whereColumn
     * @param $whereTitle
     * @param $title 与 $whereTitle 是对应关系,$whereTitle代表sql语句，$title代表绑定值
     * @param $column 与$whereColumn 是对应关系,$whereColumn代表sql语句,$column代表绑定值
     * @return int
     */
    function getCount($whereStatus,$column,$title,$whereTitle,$whereColumn){


        $sql = 'SELECT count(*) as total FROM '.$this->table.' WHERE '.$whereStatus.$whereTitle.$whereColumn.' AND softDelete=0';

        $stm = $this->mysql->prepare($sql);

        if(!$stm){
            echo $sql;
            dd('查询总数编译出错');
        }

        if(!empty($title)){
            $title .= '%';
            $stm->bind_param('s',$title);
        }

        if(is_numeric($column)){
            $stm->bind_param('i',$column);
        }



        $stm->bind_result($total);

        $stm->execute();

        if(!$stm->fetch())
            return 0;

        $stm->free_result();

        $stm->close();

        return $total;
    }

    //封装查询语句,$num = 1 如果取一条
    function query($sql,$num = ''){
        $result =  $this->mysql->query($sql);
        if(!$result){
            echo 'SQL语句有误<br>';
            echo 'ERROR:'.$this->mysql->errno.'|'.$this->mysql->error;
            die();
        }
        $rows = [];
        while($row=$result->fetch_assoc()){ //关联结果集
            array_push($rows, $row);
        }
        $result->free_result();

        if($num==1){
            return $row[0];
        }

        return $rows;
    }

    function queryNOResult($sql){

        $result =  $this->mysql->query($sql);

        if(!$result){
            echo "SQL语句有误<br>";
            echo "ERROR:".$mysqli->errno."|".$mysqli->error;
            exit;
        }

        if($this->mysql->affected_rows > 0){
           return 0;
        }

        return 1;

    }


}