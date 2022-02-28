<?php

class MySession implements SessionHandlerInterface{
    private $ip;
    private $time;
    private $mysql;

    public function __construct(){
        $this->ip = CIP;
        $this->time = TIME;
        $this->mysql = app('db');
    }

    /**
     * $savePath��$seessionName����php.ini����ģ��ص���ʱ��php���Զ�����
     * @param string $savePath
     * @param string $seessionName
     * @return bool
     */

    public function open($savePath,$seessionName){
        return true;
    }

    public function close(){
        return true;
    }

    //��session��ʱ��
    public function read($id){

        $arr = $this->getSessionBySid($id);
        if (empty($arr)){
            return '';
        }

        //Ч��session�ĺϷ���
        if($this->ip != $arr['ip']){
            $this->destroy($id);
            return '';
        }

        //php.ini ��1440�� = 24���� session������
       // $maxlifetime = ini_get('session.gc_maxlifetime');
        $maxlifetime = 86400; // session�������ʱ��  24Сʱ
        if ( ($arr['update_time']+$maxlifetime < $this->time) ) {
            $this->destroy($id);
            return '';
        }

        //return serialize($arr['data']);
        return (string)$arr['data'];
    }

    public function write($id,$data){

        $return = true;
        $arr = $this->getSessionBySid($id);
        if($arr['sid']!=NULL){
            //���ݲ�ͬҪ��ʱ����
            if( $arr['data'] != $data ) {

                $sql = 'UPDATE pre_session SET update_time = ? , data = ? WHERE sid = ?';
                $param = array('sid'=>'','update_time'=>'','data'=>'');
                $stmt = $this->mysql->prepare($sql);
                $stmt->bind_param('iss',$param['update_time'],$param['data'],$param['sid']);
                $param['sid'] = $id;
                $param['update_time'] = $this->time;
                $param['data'] = $data;
                $stmt->execute();
                $stmt->close();
            }
            //ͬʱ�û��ƶ����Ȼʱ�������session�ʱ�䣬��ֹ���ڵ�½���˳��ˣ����� ��ֹƵ����д�� ����30����ʱ��
            elseif ($this->time > $arr['update_time']+30) {
                $sql = 'UPDATE pre_session SET update_time = ?  WHERE sid = ?';
                $param = array('sid'=>'','update_time'=>'');
                $stmt = $this->mysql->prepare($sql);
                $stmt->bind_param('is',$param['update_time'],$param['sid']);
                $param['sid'] = $id;
                $param['update_time'] = $this->time;
                $stmt->execute();
                $stmt->close();
            }
        }
        //û�в�ѯ��session����
        elseif(!empty($data)) {

            $sql = 'INSERT INTO pre_session (sid,update_time,ip,`data`) VALUES (?,?,?,?)';
            $stmt = $this->mysql->prepare($sql);

            $param = array('sid'=>'','update_time'=>'','ip'=>'','data'=>'');

            $stmt->bind_param('siss',$param['sid'],$param['update_time'],$param['ip'],$param['data']);

            $param['sid'] = $id;
            $param['update_time'] = $this->time;
            $param['ip'] = $this->ip;
            $param['data'] = $data;


            $result =  $stmt->execute();

            if($result==false){
                // print_r($stmt->error_list);
                printf("Error: %s.\n", $stmt->error);
                //Warning:  session_write_close(): Failed to write session data using user defined save handler. (session.save_path: ) in Unknown on line 0
                //����false sessionд��ʧ��
                $return = false;
            }
            // die('д��sessionʧ��');

            //echo "<br/>���ID".$stmt->insert_id."<br>";
            // echo "<br/>Ӱ����".$stmt->affected_rows."��<br>";
            $stmt->close();
        }

      //  app('db')->close();���ﲻҪ�ر����ӣ���Ҫ�ڳ������������ִ�������ٹرգ���������ѧ
        return $return;
    }

    public function getSessionBySid($id){
        $sql = 'SELECT sid ,update_time,ip,`data` FROM pre_session WHERE sid= ?';
        $stmt = $this->mysql->prepare($sql);
        if(!$stmt){
            echo $sql.$id;
            dd($this->mysql->error);
            die('�����ѯID����');
        }
        $stmt->bind_param('s',$id);
        $stmt->bind_result($sid,$update_time,$ip,$data);
        $stmt->execute();

        if (!$stmt->fetch()){
            $arr =  '';
        }
        $arr = ['sid'=>$sid,'update_time'=>$update_time,'ip'=>$ip,'data'=>$data];
        $stmt->free_result();
        $stmt->close();
       // app('db')->close();
        return $arr;
    }

    public function destroy($id){
        $sql = 'DELETE FROM pre_session WHERE sid = ?';
        $stmt = $this->mysql->prepare($sql);
        $stmt->bind_param('i',$id);
        $res = $stmt->execute();
       /* if($res==false)
            echo $res;*/
        $stmt->close();
       // app('db')->close();
    }

    //sesseion���գ��������ջ��Ƶĸ���
    public function gc($maxlifetime){
        $sql = 'DELETE FROM pre_session WHERE update_time < ?';
        $stmt = $this->mysql->prepare($sql);
        $stmt->bind_param('i',(int)$this->time-$maxlifetime);
        $stmt->execute();
        $stmt->close();
       // app('db')->close();
    }
}

$handler = new MySession();

//�Զ������sessionд�뷽ʽ��д������
session_set_save_handler($handler, true);
//��������ǹ�ʱ�ķ������Ѽ��������ˣ�����ֻҪʵ�ֽӿھ����ˡ�ini_set('session.save_handler','user');

//session_startִ�к󣬻��Զ�����read,write,gc����
session_start();
