<?php


namespace App\Controllers\Home;

//������
use App\Event\Beanstalkd;

ini_set('default_socket_timeout',43200); //���ó�ʱʱ��Ϊ���죬������linux����������

class Consumer extends Beanstalkd
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Index() {
        //ȡ���ܵ�����������
        while(true){
            //����ĳ���ܵ�
            $job = $this->ph->watch('notifyAnswer')
                ->watch('notifyQuesting')
                ->watch('notifySupplement')
                ->reserve(60);//

            if (isset($job)) {
                try{
                    echo "------ ������ʻش�����û���֪ͨ------".PHP_EOL;
                    //ȡ������洢��ֵ
                    $json = json_decode($job->getData());

                    echo 'toUserId:'.$json->toUserId.PHP_EOL; echo 'uid:'.$json->uid.PHP_EOL; echo 'msgid:'.$json->msgid.PHP_EOL;

                    if(isset($json->type))echo 'type:'.$json->type.PHP_EOL;

                    $this->ph->delete($job);//ҵ�������ˣ�Ҫɾ�����������ɾ�����񣬻ᳬʱ�ַŻعܵ���Ҫ����һ�Ρ�

                } catch(\Throwable $t){
                    logs(['notifyAnswer'=>'����ʧ��','Burying job'=>$job->getId(),'error1:'=>$t->getMessage(),'error2:'=>$t->getTraceAsString()]);
                    $this->ph->bury($job); //������Ԥ�����������ܱ�����,Ҫ��peekBuried������ȡԤ��������kickJob������Ϊready����״̬�������ѡ�
                }
            }
/*
            //������ʻش�����û���֪ͨ
           try{
                $notifyAnswerJobs = $this->ph->statsTube('notifyAnswer')['total-jobs']; //��ȡ�ܵ�����Ϣ

               for($i = 0; $i < $notifyAnswerJobs; $i++){

                   $job = $this->ph->watch('notifyAnswer')->reserve(60);

                   if (isset($job)) {

                       try{
                           echo "------ ������ʻش�����û���֪ͨ------".PHP_EOL;
                           //ȡ������洢��ֵ
                           $json = json_decode($job->getData());

                           echo 'toUserId:'.$json->toUserId.PHP_EOL; echo 'uid:'.$json->uid.PHP_EOL; echo 'msgid:'.$json->msgid.PHP_EOL;

                           $this->ph->delete($job);

                       } catch(\Throwable $t){
                           logs(['notifyAnswer'=>'����ʧ��','Burying job'=>$job->getId(),'error1:'=>$t->getMessage(),'error2:'=>$t->getTraceAsString()]);
                           $this->ph->bury($job); //������Ԥ������
                       }
                   }


               }

            } catch (Exception $e){
                if($e->getMessage()=='Server reported NOT_FOUND'){     //tube ������
                   // $current_jobs_ready = 0;
                }
            }


            //�����û�׷�ʺ�����ʷ�֪ͨ
            try{
                $notifyQuestingJobs = $this->ph->statsTube('notifyQuesting')['total-jobs'];
                for($i = 0; $i < $notifyQuestingJobs; $i++){

                    $job = $this->ph->watch('notifyQuesting')->reserve();

                    if (isset($job)) {

                        try{
                            echo "------ �����û�׷�ʺ�����ʷ�֪ͨ------".PHP_EOL;
                            //ȡ������洢��ֵ
                            $json = json_decode($job->getData());

                            echo 'toUser:'.$json->toUserId.PHP_EOL; echo 'uid:'.$json->uid.PHP_EOL; echo 'msgid:'.$json->msgid.PHP_EOL;

                            $this->ph->delete($job);

                        } catch(\Throwable $t){
                            logs(['notifyQuesting'=>'����ʧ��','Burying job'=>$job->getId(),'error1:'=>$t->getMessage(),'error2:'=>$t->getTraceAsString()]);
                            $this->ph->bury($job); //������Ԥ������
                        }
                    }

                }

            } catch (Exception $e){
                if($e->getMessage()=='Server reported NOT_FOUND'){     //tube ������
                    // $current_jobs_ready = 0;
                }
            }

            //�����û������������ѯ�������еĹ��ʷ�֪ͨ
            try{

                $notifySupplementJobs = $this->ph->statsTube('notifySupplement')['total-jobs'];

                for($i = 0; $i < $notifySupplementJobs; $i++){

                    $job = $this->ph->watch('notifySupplement')->reserve();

                    if (isset($job)) {

                        try{
                            echo "------ �����û������������ѯ�������еĹ��ʷ�֪ͨ------".PHP_EOL;
                            //ȡ������洢��ֵ
                            $json = json_decode($job->getData());

                            echo 'toUser:'.$json->toUserId.PHP_EOL; echo 'uid:'.$json->uid.PHP_EOL; echo 'msgid:'.$json->msgid.PHP_EOL; echo 'type:'.$json->type.PHP_EOL;

                            $this->ph->delete($job);

                        } catch(\Throwable $t){
                            logs(['notifySupplement'=>'����ʧ��','Burying job'=>$job->getId(),'error1:'=>$t->getMessage(),'error2:'=>$t->getTraceAsString()]);
                            $this->ph->bury($job); //������Ԥ������
                        }
                    }
                }



            } catch (Exception $e){
                if($e->getMessage()=='Server reported NOT_FOUND'){     //tube ������
                    // $current_jobs_ready = 0;
                }
            }
*/
          }

    }
}