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
     * $savePath、$seessionName数是php.ini里面的，回调的时候php会自动传入
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

    //读session的时候
    public function read($id){

        $arr = $this->getSessionBySid($id);
        if (empty($arr)){
            return '';
        }

        //效验session的合法性
        if($this->ip != $arr['ip']){
            $this->destroy($id);
            return '';
        }

        //php.ini 是1440秒 = 24分钟 session过期了
       // $maxlifetime = ini_get('session.gc_maxlifetime');
        $maxlifetime = 86400; // session最大生存时间  24小时
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
            //数据不同要即时更新
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
            //同时用户移动鼠标等活动时候，须更新session活动时间，防止过期登陆就退出了，但是 防止频繁的写， 大于30秒延时。
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
        //没有查询到session数据
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
                //返回false session写入失败
                $return = false;
            }
            // die('写入session失败');

            //echo "<br/>最后ID".$stmt->insert_id."<br>";
            // echo "<br/>影响了".$stmt->affected_rows."行<br>";
            $stmt->close();
        }

      //  app('db')->close();这里不要关闭连接，，要在程序的生命周期执行完了再关闭，这样更科学
        return $return;
    }

    public function getSessionBySid($id){
        $sql = 'SELECT sid ,update_time,ip,`data` FROM pre_session WHERE sid= ?';
        $stmt = $this->mysql->prepare($sql);
        if(!$stmt){
            echo $sql.$id;
            dd($this->mysql->error);
            die('编译查询ID出错');
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

    //sesseion回收，触发回收机制的概率
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

//自定义控制session写入方式和写入内容
session_set_save_handler($handler, true);
//设置这个是过时的方法：已级不能用了，现在只要实现接口就行了。ini_set('session.save_handler','user');

//session_start执行后，会自动触发read,write,gc函数
session_start();
