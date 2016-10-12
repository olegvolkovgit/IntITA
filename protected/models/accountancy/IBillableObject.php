<?php
interface IBillableObject
{
    public function getBasePrice();
    public function getDuration();
    public function getModelUAH();
}