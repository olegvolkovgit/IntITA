<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 04.06.2015
 * Time: 16:06
 */

class PayController extends Controller{

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionPayNow(){
        $permission = new Permissions();
        $permission->setRead($_POST['user'], $_POST['module']);

//        if(isset($_POST['module'])) {
//            if (Permissions::model()->exists('id_user=:user and id_resource=:resource', array(':user' => $_POST['user'], ':resource' => $_POST['lecture']))) {
//                Permissions::model()->updateByPk(array('id_user' => $_POST['user'], 'id_resource' => $_POST['lecture']), array('rights' => Permissions::setFlags($rights)));
//            } else {
//                $user = Yii::app()->db->createCommand()->insert('permissions', array(
//                    'id_user' => $_POST['user'],
//                    'id_resource' => $_POST['lecture'],
//                    'rights' => Permissions::setFlags($rights),
//                ));
//            }
//        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }
}