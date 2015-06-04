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
        $rights = [];
        if (isset($_POST['read'])) {
            array_push($rights, 'read');
        }
        if (isset($_POST['edit'])) {
            array_push($rights, 'edit');
        }
        if (isset($_POST['create'])) {
            array_push($rights, 'create');
        }
        if (isset($_POST['delete'])) {
            array_push($rights, 'delete');
        }

        if(isset($_POST['lecture'])) {
            if (Permissions::model()->exists('id_user=:user and id_resource=:resource', array(':user' => $_POST['user'], ':resource' => $_POST['lecture']))) {
                Permissions::model()->updateByPk(array('id_user' => $_POST['user'], 'id_resource' => $_POST['lecture']), array('rights' => Permissions::setFlags($rights)));
            } else {
                $user = Yii::app()->db->createCommand()->insert('permissions', array(
                    'id_user' => $_POST['user'],
                    'id_resource' => $_POST['lecture'],
                    'rights' => Permissions::setFlags($rights),
                ));
            }
        }
       // $this->actionIndex();

        $this->redirect(Yii::app()->request->urlReferrer);
    }
}