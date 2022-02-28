<?php


namespace App\Models;


class TreeModel extends Model
{
    protected $mysql;
    protected $table; //���ݿ���� �� Ĭ���ǹ�����Ŀ��


    function __construct($table)
    {
        $this->mysql = app('db');
        $this->table = PREFIX.$table ;

    }

    /**��ӽڵ�
     * @param mixed ...$parameter �����յ����ݱ���Ϊ�����ʽ
     * �������밴�ֶε�˳������
     * @return array
     */
    function InsertNode(...$parameter){


        $sql = 'INSERT INTO '.$this->table.' (id,text,pid,level) VALUES (?,?,?,?)';
        $stmt = $this->mysql->prepare($sql);


        $stmt->bind_param('isii',$parameter[0],$parameter[1],$parameter[2],$parameter[3]);


        $result = $stmt->execute();


        if($result==false){
            print_r($stmt->error_list);
            die('sqlִ��ʧ��');
        }

        $stmt->close();

        return ['error'=>0];
    }

    /** �޸Ľڵ�
     * @param mixed ...$param �����յ����ݱ���Ϊ�����ʽ
     * @return array
     */
    function UpdateNode(...$param){
        $sql = 'UPDATE  '.$this->table.' SET text = ?,pid = ?, level = ? WHERE id = ?';

        $stmt = $this->mysql->prepare($sql);

        $array = ['text'=>'','pid'=>'','level'=>'','id'=>''];
        $result =  $stmt->bind_param('siii',$array['text'],$array['pid'],$array['level'],$array['id']);

        if($result==false)
            die('������ʧ��');

        $array['text'] = $param[1];
        $array['pid'] = $param[2];
        $array['level'] = $param[3];
        $array['id'] = $param[0];

        $result =  $stmt->execute();

        if($result==false){
            print_r($stmt->error_list);
            die('sqlִ��ʧ��');
        }

        $stmt->close();

        //Ӱ������� $result = $stmt->affected_rows;

        return ['error'=>0];
    }

    /**ȡ���� tree �ڵ�
     *��children����ʽ�ṹ���tree����,children�������ӽڵ�
     * @param int $pid
     * Ĭ�ϻ�ȡ���еĽڵ� �����ָ���ڵ����ȡ���ڵ���������нڵ㣨�������ڵ㣩
     * @return array [{ id: "lists", text: "Lists", expanded: false,children: [
                                                            { id: "datagrid", text: "DataGrid" },
                                                            { id: "tree", text: "Tree" }
                    ]}
     */
    function GetNodeAll( $pid = -1 ){
        $rows = [];

        $sql = 'SELECT id,text,pid,img,url FROM '.$this->table.' WHERE pid = '.$pid;
        //������
        $result = $this->mysql->query($sql);

        if(!$result){
            echo 'SQL�������<br>';
            echo 'ERROR:'.$this->mysql->errno.'|'.$this->mysql->error;
            die();
        }


        while($row=$result->fetch_assoc()){ //���������


            $rowSon = $this->GetNodeAll($row['id']);

            if(count($rowSon)){
                $row['children'] = [];
               $row['children'] += $rowSon;//Array ( [0] => Array ( [id] => 3 [text] => ������Ŀ ) )

               //array_push($row['children'],$rowSon);//Array ( [0] => Array ( [0] => Array ( [id] => 3 [text] => ������Ŀ ) ) )


            }
            array_push($rows, $row);

        }

        $result->free_result();
      //  $result->close();
        return $rows;
    }

    /**ȡ���� tree �ڵ�
     * ���Խ�children����ʽ�����tree������pid��ʽ�����ڵ�
     * @return array [{id: "base", text: "Base", checked: true},
                    {id: "ajax", text: "Ajax", pid: "base"}]
     */
    function GetNodeList(){
        $rows = [];

        $sql = 'SELECT id,text,pid,img,url,weight FROM '.$this->table.' WHERE softDelete = 0 ORDER BY weight DESC';
        //������
        $result = $this->mysql->query($sql);

        if(!$result){
            echo 'SQL�������<br>';
            echo 'ERROR:'.$this->mysql->errno.'|'.$this->mysql->error;
            die();
        }

        while($row=$result->fetch_assoc()){ //���������
            array_push($rows, $row);
        }
        $result->free_result();

        return $rows;
    }

    //��ȡһ����¼
    function GetNodeById($id){
        $sql = 'SELECT url,img,weight FROM '.$this->table.' WHERE id = ? ';

        $stmt = $this->mysql->prepare($sql);

        if(!$stmt){
            die('sql����ʧ��');
        }

        $result = $stmt->bind_param('i',$id);

        if($result==false){
            print_r($stmt->error_list);
            die('�󶨲���ʧ��');
        }

        $stmt->bind_result($url,$img,$weight);
        $stmt->execute();

        //ȡһ��
        if (!$stmt->fetch()){
            $arr =  '';
        }

        $stmt->free_result();
        $stmt->close();
        $arr = ['url'=>$url,'id'=>$id,'img'=>$img,'weight'=>$weight];

       return $arr;

    }

    /**
     * @param $id
     * @return array 1�����ύʧ��
     */
    function RemoveNode($id){

       // $sql = 'DELETE FROM pre_column WHERE id = '. $id;

        $sql = 'UPDATE  '.$this->table.'  SET softDelete = 1,deleteTime= '.TIME.' WHERE id = '. $id;

        $result = $this->mysql->query($sql);

        if(!$result){
            echo 'SQL�������<br>';
            echo 'ERROR:'.$this->mysql->errno.'|'.$this->mysql->error;
            die();
        }


        $result->close();

        if($this->mysql->affected_rows > 0){
            return ['error'=>0];
        }

        return ['error'=>1];

    }

    function UpdateImg($img,$id){
        $sql = 'UPDATE '.$this->table.'  SET img=? WHERE id =?';
        $num =  $this->SqlPrepareAndExecute( $sql, 'si', $img,$id);
        if(!$num){
            return  ['error'=>0];
        }else{
            return  ['error'=>1];
        }

    }

    function UpdateWeight($weight,$id){
        $sql = 'UPDATE '.$this->table.'  SET weight=? WHERE id =?';
        $num =  $this->SqlPrepareAndExecute( $sql, 'ii', $weight,$id);
        if(!$num){
            return  ['error'=>0];
        }else{
            return  ['error'=>1];
        }
    }

    function UpdateUrl(...$param){
        $stmt = $this->mysql->prepare('UPDATE '.$this->table.'  SET url=? WHERE id =?');

        $data = array("si",$param[0],$param[1]);

        $ref = new \ReflectionClass('mysqli_stmt');

        $method = $ref->getMethod("bind_param");

        $method->invokeArgs($stmt,$data);

        if ($stmt) {
            if($stmt->execute()){
                $stmt->close();
                return ['error'=>0];
            }
            else{
                print_r($stmt->error_list);
                die('�޸�ʧ��');
            }
            return ['error'=>1];

        }else{
            die('sql����ʧ��');
        }

    }

    //���ض�ά����
    function GetNodeByIn($ids){

        if(is_array($ids)){
            $ids =  implode(',',$ids);
        }else{
            $ids = rtrim($ids,',');
        }

        $sql = 'SELECT id,url,text,img,pid FROM '.$this->table.' WHERE id in ('.$ids.')';

        $arr = $this->query($sql);

        return $arr;
    }
}