<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 29.08.2015
 * Time: 15:14
 */

class ShareController extends Controller{



    public function actionIndex(){
        if (AccessHelper::isHasAccessFileShare()) {
            $this->render('index');
        } else {
            throw new CHttpException(403, 'У вас недостатньо прав для доступу до цієї сторінки');
        }
    }
}