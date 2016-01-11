<?php

class ShareController extends Controller{

    public function actionIndex(){

        if (StudentReg::isHasAccessFileShare()) {

            $shareLink = ShareLink::model()->findAll();

            $this->render('index',array('shareLink' => $shareLink));
        }
        else
        {
            throw new CHttpException(403, 'У вас недостатньо прав для доступу до цієї сторінки');
        }
    }
}