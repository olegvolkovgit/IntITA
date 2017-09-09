<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 28.11.2016
 * Time: 13:03
 */


class WebSocketCommand extends CConsoleCommand
{

    const LOG_FILE = '/var/log/intitaWebsocket.log';
    const PID_FILE = '/var/run/intitaWebsocket.pid';

    use NotifySubscribedUsers;


    public function actionStartServer(){
        if (!$this->checkServer(true)){
            $this->startServer();
            echo 'Starting server!';
        }
    }

    public function actionTestServer($topic){

        $this->notifyUser($topic,['test'=>'testData']);
    }

    public function actionStatus(){
        $this->checkServer(true);
    }

    public function actionStopServer(){
        $this->stopServer();
    }

    public function actionRestartServer(){
        $this->stopServer();
        $this->startServer();
    }


    private function startServer(){
        file_put_contents('/var/run/intitaWebsocket.pid', '');
        exec(sprintf("%s > %s 2>&1 & echo $! >> %s",
            'php '.__DIR__.'/../components/WebSocket/WebSocketServer.php',
            $this::LOG_FILE, $this::PID_FILE));
    }

    private function stopServer(){
        if($this->checkServer(false)){
            $pid = file($this::PID_FILE)[0];
            exec('kill -9 '.$pid);
        }
    }

    private function checkServer($echo){
        if (file_exists('/var/run/intitaWebsocket.pid')){
            $pid = file($this::PID_FILE);
            if (count($pid)>0){
                $result = shell_exec(sprintf("ps %d", $pid[0]));
                if( count(preg_split("/\n/", $result)) > 2){
                    if ($echo){
                        echo 'Server is running PID: '.$pid[0];
                    }
                    return true;
                }
            }
        }
        if ($echo){
            echo "Server is not running \n";
        }
        return false;
    }
}