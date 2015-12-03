<?php

class TrainerController extends AdminController{

    public function actionIndex(){
        $answers = PlainTaskAnswer::getAllPlainTaskAnswers();

        $this->render('index', array(
            'answers' => $answers,
        ));
    }
}