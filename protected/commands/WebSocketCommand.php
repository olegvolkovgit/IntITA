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
        if (file_exists('/var/run/intitaWebsocket.pid')){
            $pid = file('/var/run/intitaWebsocket.pid');
            if (count($pid)>0){
                $result = shell_exec(sprintf("ps %d", $pid[0]));
                if( count(preg_split("/\n/", $result)) > 2){
                    echo 'Server is running PID: '.$pid[0];
                }
                else{
                    $this->startServer();
                }
            }
            else{
                $this->startServer();
            }

        }
        else{
            $this->startServer();
        }
    }

    public function actionTestServer(){

        $this->notifyUser('newMessages-319',['messages'=>19]);
    }


    private function startServer(){
        file_put_contents('/var/run/intitaWebsocket.pid', '');
        exec(sprintf("%s > %s 2>&1 & echo $! >> %s",
            'php '.__DIR__.'/../components/WebSocket/WebSocketServer.php',
            '/var/log/intitaWebsocket.log', '/var/run/intitaWebsocket.pid'));
    }


}