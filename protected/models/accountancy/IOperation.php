<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 08.12.2015
 * Time: 0:13
 */

interface IOperation {

    public function perform($summa, $user, $type, $invoicesListId, $externalSource);

    public function cancel();

}