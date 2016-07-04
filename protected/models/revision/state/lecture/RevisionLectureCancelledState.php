<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 01.07.16
 * Time: 20:47
 */
class RevisionLectureCancelledState extends RevisionState {

    protected function _init() {
        $this->stateName = "Скасована";
    }

}