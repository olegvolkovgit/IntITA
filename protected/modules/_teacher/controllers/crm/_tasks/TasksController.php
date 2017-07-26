<?php

class TasksController extends TeacherCabinetController {
    public function hasRole() {
        return true;
    }

    public function actionIndex($id = 0) {
        $this->renderPartial('/crm/_tasks/index', array(), false, true);
    }

    public function actionMyTasks() {
        $this->renderPartial('/crm/_tasks/myTasks', array(), false, true);
    }

    public function actionHelpsTasks() {
        $this->renderPartial('/crm/_tasks/helpsTasks', array(), false, true);
    }

    public function actionEntrustTasks() {
        $this->renderPartial('/crm/_tasks/entrustTasks', array(), false, true);
    }

    public function actionWatchTasks() {
        $this->renderPartial('/crm/_tasks/watchTasks', array(), false, true);
    }
}