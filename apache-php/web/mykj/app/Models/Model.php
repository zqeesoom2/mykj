<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/6/14 0014
 * Time: ���� 1:14
 */

namespace App\Models;


class Model
{

    /** û�н������Ԥ����
     * @param $sql
     * @param $types  �ַ���
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
            die('�޸ı������');
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
                return ['error'=>1,'msg'=>'�޸�ʧ��'];
            }

        }
    }



    function delete($id){
        $sql = 'UPDATE  '.$this->table.'  SET softDelete = 1,deleteTime= '.TIME.' WHERE id = ?';

        $smt = $this->mysql->prepare($sql);

        if(!$smt){
            echo $sql;
            die('ɾ�����ű������');
        }

        $smt->bind_param('i',$id);

        if($smt->execute()) {
            $smt->close();
            return 0;
        }else{
            print_r($smt->error_list);
            return 1;//ʧ��
        }

    }
    //��ȡ�ܼ�¼��

    /**
     * @param $whereStatus
     * @param $whereColumn
     * @param $whereTitle
     * @param $title �� $whereTitle �Ƕ�Ӧ��ϵ,$whereTitle����sql��䣬$title�����ֵ
     * @param $column ��$whereColumn �Ƕ�Ӧ��ϵ,$whereColumn����sql���,$column�����ֵ
     * @return int
     */
    function getCount($whereStatus,$column,$title,$whereTitle,$whereColumn){


        $sql = 'SELECT count(*) as total FROM '.$this->table.' WHERE '.$whereStatus.$whereTitle.$whereColumn.' AND softDelete=0';

        $stm = $this->mysql->prepare($sql);

        if(!$stm){
            echo $sql;
            dd('��ѯ�����������');
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

    //��װ��ѯ���,$num = 1 ���ȡһ��
    function query($sql,$num = ''){
        $result =  $this->mysql->query($sql);
        if(!$result){
            echo 'SQL�������<br>';
            echo 'ERROR:'.$this->mysql->errno.'|'.$this->mysql->error;
            die();
        }
        $rows = [];
        while($row=$result->fetch_assoc()){ //���������
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
            echo "SQL�������<br>";
            echo "ERROR:".$mysqli->errno."|".$mysqli->error;
            exit;
        }

        if($this->mysql->affected_rows > 0){
           return 0;
        }

        return 1;

    }


}