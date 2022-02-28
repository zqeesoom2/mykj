<?php


namespace App\Models;


class TreeModel extends Model
{
    protected $mysql;
    protected $table; //数据库表名 ， 默认是功能栏目表


    function __construct($table)
    {
        $this->mysql = app('db');
        $this->table = PREFIX.$table ;

    }

    /**添加节点
     * @param mixed ...$parameter 将接收的数据保存为数组格式
     * 参数必须按字段的顺序排列
     * @return array
     */
    function InsertNode(...$parameter){


        $sql = 'INSERT INTO '.$this->table.' (id,text,pid,level) VALUES (?,?,?,?)';
        $stmt = $this->mysql->prepare($sql);


        $stmt->bind_param('isii',$parameter[0],$parameter[1],$parameter[2],$parameter[3]);


        $result = $stmt->execute();


        if($result==false){
            print_r($stmt->error_list);
            die('sql执行失败');
        }

        $stmt->close();

        return ['error'=>0];
    }

    /** 修改节点
     * @param mixed ...$param 将接收的数据保存为数组格式
     * @return array
     */
    function UpdateNode(...$param){
        $sql = 'UPDATE  '.$this->table.' SET text = ?,pid = ?, level = ? WHERE id = ?';

        $stmt = $this->mysql->prepare($sql);

        $array = ['text'=>'','pid'=>'','level'=>'','id'=>''];
        $result =  $stmt->bind_param('siii',$array['text'],$array['pid'],$array['level'],$array['id']);

        if($result==false)
            die('参数绑定失败');

        $array['text'] = $param[1];
        $array['pid'] = $param[2];
        $array['level'] = $param[3];
        $array['id'] = $param[0];

        $result =  $stmt->execute();

        if($result==false){
            print_r($stmt->error_list);
            die('sql执行失败');
        }

        $stmt->close();

        //影响的行数 $result = $stmt->affected_rows;

        return ['error'=>0];
    }

    /**取所有 tree 节点
     *以children的形式结构组合tree对象,children代表有子节点
     * @param int $pid
     * 默认获取所有的节点 ，如果指定节点则获取本节点下面的所有节点（包括本节点）
     * @return array [{ id: "lists", text: "Lists", expanded: false,children: [
                                                            { id: "datagrid", text: "DataGrid" },
                                                            { id: "tree", text: "Tree" }
                    ]}
     */
    function GetNodeAll( $pid = -1 ){
        $rows = [];

        $sql = 'SELECT id,text,pid,img,url FROM '.$this->table.' WHERE pid = '.$pid;
        //语句对象
        $result = $this->mysql->query($sql);

        if(!$result){
            echo 'SQL语句有误<br>';
            echo 'ERROR:'.$this->mysql->errno.'|'.$this->mysql->error;
            die();
        }


        while($row=$result->fetch_assoc()){ //关联结果集


            $rowSon = $this->GetNodeAll($row['id']);

            if(count($rowSon)){
                $row['children'] = [];
               $row['children'] += $rowSon;//Array ( [0] => Array ( [id] => 3 [text] => 孙子栏目 ) )

               //array_push($row['children'],$rowSon);//Array ( [0] => Array ( [0] => Array ( [id] => 3 [text] => 孙子栏目 ) ) )


            }
            array_push($rows, $row);

        }

        $result->free_result();
      //  $result->close();
        return $rows;
    }

    /**取所有 tree 节点
     * 不以结children的形式构组合tree对象，以pid形式代表父节点
     * @return array [{id: "base", text: "Base", checked: true},
                    {id: "ajax", text: "Ajax", pid: "base"}]
     */
    function GetNodeList(){
        $rows = [];

        $sql = 'SELECT id,text,pid,img,url,weight FROM '.$this->table.' WHERE softDelete = 0 ORDER BY weight DESC';
        //语句对象
        $result = $this->mysql->query($sql);

        if(!$result){
            echo 'SQL语句有误<br>';
            echo 'ERROR:'.$this->mysql->errno.'|'.$this->mysql->error;
            die();
        }

        while($row=$result->fetch_assoc()){ //关联结果集
            array_push($rows, $row);
        }
        $result->free_result();

        return $rows;
    }

    //获取一条记录
    function GetNodeById($id){
        $sql = 'SELECT url,img,weight FROM '.$this->table.' WHERE id = ? ';

        $stmt = $this->mysql->prepare($sql);

        if(!$stmt){
            die('sql编译失败');
        }

        $result = $stmt->bind_param('i',$id);

        if($result==false){
            print_r($stmt->error_list);
            die('绑定参数失败');
        }

        $stmt->bind_result($url,$img,$weight);
        $stmt->execute();

        //取一行
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
     * @return array 1代表提交失败
     */
    function RemoveNode($id){

       // $sql = 'DELETE FROM pre_column WHERE id = '. $id;

        $sql = 'UPDATE  '.$this->table.'  SET softDelete = 1,deleteTime= '.TIME.' WHERE id = '. $id;

        $result = $this->mysql->query($sql);

        if(!$result){
            echo 'SQL语句有误<br>';
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
                die('修改失败');
            }
            return ['error'=>1];

        }else{
            die('sql编译失败');
        }

    }

    //返回多维数组
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