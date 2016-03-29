<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 28.12.2015
 * Time: 13:18
 */
class AuthorizationFormWidget extends CWidget
{
    public $form;
    public $id;
    public $dialog;
    public $authMode='signIn';
    public $action='site/signInSignUp';
    public $callBack;


    public function run()
    {
        $model = new StudentReg();
        if($this->dialog=='true') $this->form='authFormDialog';
        else $this->form='authForm';
        $this->render('AuthorizationForm/' . $this->form, array(
            'model'=>$model,'id'=>$this->id,'mode'=>$this->authMode,'action'=>$this->action,'callBack'=>$this->callBack
        ));
    }
}