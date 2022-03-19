<?php


namespace App\Controllers\Home;

//消费者
use App\Event\Beanstalkd;

ini_set('default_socket_timeout',43200); //设置超时时间为半天，可以用linux任务来消费

class Consumer extends Beanstalkd
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Index() {
        //取出管道的任务总数
        while(true){
            //监听某个管道
            $job = $this->ph->watch('notifyAnswer')
                ->watch('notifyQuesting')
                ->watch('notifySupplement')
                ->reserve(60);//

            if (isset($job)) {
                try{
                    echo "------ 处理顾问回答后向用户发通知------".PHP_EOL;
                    //取出任务存储的值
                    $json = json_decode($job->getData());

                    echo 'toUserId:'.$json->toUserId.PHP_EOL; echo 'uid:'.$json->uid.PHP_EOL; echo 'msgid:'.$json->msgid.PHP_EOL;

                    if(isset($json->type))echo 'type:'.$json->type.PHP_EOL;

                    $this->ph->delete($job);//业务处理完了，要删除任务。如果不删除任务，会超时又放回管道又要消费一次。

                } catch(\Throwable $t){
                    logs(['notifyAnswer'=>'消费失败','Burying job'=>$job->getId(),'error1:'=>$t->getMessage(),'error2:'=>$t->getTraceAsString()]);
                    $this->ph->bury($job); //把任务预留起来但不能被消费,要用peekBuried方法获取预留任务，用kickJob方法改为ready正常状态才能消费。
                }
            }
/*
            //处理顾问回答后向用户发通知
           try{
                $notifyAnswerJobs = $this->ph->statsTube('notifyAnswer')['total-jobs']; //获取管道的信息

               for($i = 0; $i < $notifyAnswerJobs; $i++){

                   $job = $this->ph->watch('notifyAnswer')->reserve(60);

                   if (isset($job)) {

                       try{
                           echo "------ 处理顾问回答后向用户发通知------".PHP_EOL;
                           //取出任务存储的值
                           $json = json_decode($job->getData());

                           echo 'toUserId:'.$json->toUserId.PHP_EOL; echo 'uid:'.$json->uid.PHP_EOL; echo 'msgid:'.$json->msgid.PHP_EOL;

                           $this->ph->delete($job);

                       } catch(\Throwable $t){
                           logs(['notifyAnswer'=>'消费失败','Burying job'=>$job->getId(),'error1:'=>$t->getMessage(),'error2:'=>$t->getTraceAsString()]);
                           $this->ph->bury($job); //把任务预留起来
                       }
                   }


               }

            } catch (Exception $e){
                if($e->getMessage()=='Server reported NOT_FOUND'){     //tube 不存在
                   // $current_jobs_ready = 0;
                }
            }


            //处理用户追问后向顾问发通知
            try{
                $notifyQuestingJobs = $this->ph->statsTube('notifyQuesting')['total-jobs'];
                for($i = 0; $i < $notifyQuestingJobs; $i++){

                    $job = $this->ph->watch('notifyQuesting')->reserve();

                    if (isset($job)) {

                        try{
                            echo "------ 处理用户追问后向顾问发通知------".PHP_EOL;
                            //取出任务存储的值
                            $json = json_decode($job->getData());

                            echo 'toUser:'.$json->toUserId.PHP_EOL; echo 'uid:'.$json->uid.PHP_EOL; echo 'msgid:'.$json->msgid.PHP_EOL;

                            $this->ph->delete($job);

                        } catch(\Throwable $t){
                            logs(['notifyQuesting'=>'消费失败','Burying job'=>$job->getId(),'error1:'=>$t->getMessage(),'error2:'=>$t->getTraceAsString()]);
                            $this->ph->bury($job); //把任务预留起来
                        }
                    }

                }

            } catch (Exception $e){
                if($e->getMessage()=='Server reported NOT_FOUND'){     //tube 不存在
                    // $current_jobs_ready = 0;
                }
            }

            //处理用户补充问题或咨询后向所有的顾问发通知
            try{

                $notifySupplementJobs = $this->ph->statsTube('notifySupplement')['total-jobs'];

                for($i = 0; $i < $notifySupplementJobs; $i++){

                    $job = $this->ph->watch('notifySupplement')->reserve();

                    if (isset($job)) {

                        try{
                            echo "------ 处理用户补充问题或咨询后向所有的顾问发通知------".PHP_EOL;
                            //取出任务存储的值
                            $json = json_decode($job->getData());

                            echo 'toUser:'.$json->toUserId.PHP_EOL; echo 'uid:'.$json->uid.PHP_EOL; echo 'msgid:'.$json->msgid.PHP_EOL; echo 'type:'.$json->type.PHP_EOL;

                            $this->ph->delete($job);

                        } catch(\Throwable $t){
                            logs(['notifySupplement'=>'消费失败','Burying job'=>$job->getId(),'error1:'=>$t->getMessage(),'error2:'=>$t->getTraceAsString()]);
                            $this->ph->bury($job); //把任务预留起来
                        }
                    }
                }



            } catch (Exception $e){
                if($e->getMessage()=='Server reported NOT_FOUND'){     //tube 不存在
                    // $current_jobs_ready = 0;
                }
            }
*/
          }

    }
}