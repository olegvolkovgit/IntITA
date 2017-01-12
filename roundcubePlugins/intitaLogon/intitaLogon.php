<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 02.01.2017
 * Time: 13:30
 */
class intitaLogon extends rcube_plugin
{

    public $task = 'login';

    function init()
    {
        $this->add_hook('startup', array($this, 'startup'));
        $this->add_hook('authenticate', array($this, 'authenticate'));
    }

    function startup($args)
    {
        // change action to login
        if (empty($_SESSION['user_id']) && empty($_POST['login']))
            $args['action'] = 'login';
        return $args;
    }

    function authenticate($args)
    {
        if (!empty($_GET['intitaLogon'])) {
            $decrypted = $this->decrypt($_GET['intitaLogon']);
            if ((time()-$decrypted['time'])<60) {
                $args['user'] = $decrypted['mail'];
                $args['pass'] = $decrypted['pass'];
                $args['host'] = 'localhost';
                $args['cookiecheck'] = false;
                $args['valid'] = true;
            }
        }
        return $args;
    }

    private function decrypt($token){
        $_token = urlencode($token);
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256,md5('test'), base64_decode(urldecode($_token)),MCRYPT_MODE_ECB);
        return json_decode(rtrim($decrypted),true);
    }


}