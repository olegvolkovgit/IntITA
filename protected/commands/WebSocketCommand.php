<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 28.11.2016
 * Time: 13:03
 */


class WebSocketCommand extends CConsoleCommand
{


    use NotifySubscribedUsers;


    public function actionStartServer(){
        if ($this->checkWinEnv()) {
            $this->startServer();
            echo "Server does not support background mode in Windows hosts. \n";
            echo "Starting server! \n";
        }
        else{
            if (!$this->checkServer(true)){
                $this->startServer();
                echo "Starting server! \n";
            }
        }

    }

    public function actionTestServer($topic){

        $this->notifyUser($topic,['test'=>'testData']);
    }

    public function actionStatus(){
        if ($this->checkWinEnv()) {
            echo "Server does not support background mode in Windows hosts. Please check your console. \n";
        }
        else {
            $this->checkServer(true);
        }

    }

    public function actionStopServer(){
        if ($this->checkWinEnv()) {
            echo "Server does not support background mode in Windows hosts. Please close your console. \n";
        }
        else{
            $this->stopServer();
        }

    }

    public function actionRestartServer(){
        if ($this->checkWinEnv()) {
            echo "Server does not support background mode in Windows hosts. Please close your console and start server manually. \n";
        }
        else{
            $this->stopServer();
            $this->startServer();
        }

    }


    private function startServer(){
        file_put_contents(Yii::app()->params['webSocketServer']['pidFile'], '');
        if ($this->checkWinEnv()) {
            exec('php '.__DIR__.'/../components/WebSocket/WebSocketServer.php');
        } else {
            exec(sprintf("%s > %s 2>&1 & echo $! >> %s",
                'php '.__DIR__.'/../components/WebSocket/WebSocketServer.php',
                Yii::app()->params['webSocketServer']['logFile'], Yii::app()->params['webSocketServer']['pidFile']));
        }


    }

    private function stopServer(){
        if ($this->checkWinEnv()) {
            echo "Server does not support background mode in Windows hosts. Please close your console \n";
        }
        else{
            if($this->checkServer(false)){
                $pid = file(Yii::app()->params['webSocketServer']['pidFile'])[0];
                exec('kill -9 '.$pid);
            }
        }

    }

    private function checkServer($echo){
        if (file_exists(Yii::app()->params['webSocketServer']['pidFile'])){
            $pid = file(Yii::app()->params['webSocketServer']['pidFile']);
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

    private function checkWinEnv(){
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return true;
        }
        else{
            return false;
        }

    }
}