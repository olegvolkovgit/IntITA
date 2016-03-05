<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 07.12.2015
 * Time: 16:04
 */

class InvoiceOperation extends Operation implements IOperation
{
    public function cancel(){

    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}