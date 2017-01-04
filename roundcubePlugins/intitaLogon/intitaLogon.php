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
            $args['user'] = 'postmaster@dev.intita.com';
            $args['host'] = 'localhost';
            $args['valid'] = true;
        }
        return $args;
    }

}