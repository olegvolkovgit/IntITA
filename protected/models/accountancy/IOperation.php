<?php

interface IOperation {

    public function perform($summa, $user, $type, $invoicesListId, $externalSource);

    public function cancel();

}