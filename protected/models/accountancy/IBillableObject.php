<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 22.10.2015
 * Time: 14:01
 */
interface IBillableObject
{
    public function getBasePrice();
    public function getDuration();
    public function getModelUAH();
}