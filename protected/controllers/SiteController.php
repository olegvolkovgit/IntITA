<?php

class SiteController extends Controller
{
	/* @var $mainpage Mainpage*/
	/* @var $step1 Step*/
	/* @var $step2 Step*/
	/* @var $step3 Step*/
	/* @var $step4 Step*/
	/* @var $step5 Step*/
	/* @var $objAbout1 AboutUs*/
	/* @var $objAbout2 AboutUs*/
	/* @var $objAbout3 AboutUs*/
    /*
	 * Declares class-based actions.
	 */
    public $source;

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index1.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index1.php'
		// using the default layout 'protected/views/layouts/main.php'
		$mainpage = Mainpage::model()->findByPk(0);

		$arraySteps = $this->initSteps();
		$arrayAboutUs = $this->initAboutus();

		$this->render('index', array(
            'mainpageModel'=>$mainpage,
			'mainpage'=>array(
				'stepSize'=>$mainpage->stepSize,
			),
			'block1'=>$arrayAboutUs['objAbout1'],
			'block2'=>$arrayAboutUs['objAbout2'],
			'block3'=>$arrayAboutUs['objAbout3'],
			'step1'=>$arraySteps['step1'],
			'step2'=>$arraySteps['step2'],
			'step3'=>$arraySteps['step3'],
			'step4'=>$arraySteps['step4'],
			'step5'=>$arraySteps['step5'],
		));
	}

	public function initAboutus(){
		$objAbout1 = new AboutUs(1);
		$objAbout1->setValuesById(1);
		$objAbout1->titleText = Yii::t('aboutus', '0032');
		$objAbout1->textAbout = Yii::t('aboutus', '0035');
		$objAbout2 = new AboutUs(2);
		$objAbout2->setValuesById(2);
		$objAbout2->titleText = Yii::t('aboutus', '0033');
		$objAbout2->textAbout = Yii::t('aboutus', '0036');
		$objAbout3 = new AboutUs(3);
		$objAbout3->setValuesById(3);
		$objAbout3->titleText = Yii::t('aboutus', '0034');
		$objAbout3->textAbout = Yii::t('aboutus', '0037');
		return $arrayAboutUs = array(
			'objAbout1'=>$objAbout1,
			'objAbout2'=>$objAbout2,
			'objAbout3'=>$objAbout3,
		);
	}

	public function initSteps(){
		$step1 = Step::model()->findByPk(1);
		$step2 = Step::model()->findByPk(2);
		$step3 = Step::model()->findByPk(3);
		$step4 = Step::model()->findByPk(4);
		$step5 = Step::model()->findByPk(5);

		$step1->stepTitle =  Yii::t('step','0038');
		$step2->stepTitle =  Yii::t('step','0039');
		$step3->stepTitle =  Yii::t('step','0040');
		$step4->stepTitle =  Yii::t('step','0041');
		$step5->stepTitle =  Yii::t('step','0042');

		$step1->stepText =  Yii::t('step','0044');
		$step2->stepText =  Yii::t('step','0045');
		$step3->stepText =  Yii::t('step','0046');
		$step4->stepText =  Yii::t('step','0047');
		$step5->stepText =  Yii::t('step','0048');


		return $arraySteps = array(
			'step1'=>$step1,
			'step2'=>$step2,
			'step3'=>$step3,
			'step4'=>$step4,
			'step5'=>$step5,
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionChangeLang($lg)
	{
        $app = Yii::app();
		if (isset($_GET['lg'])) {
			$app->session['lg'] = $_GET['lg'];
		}
        if (isset($_SERVER["HTTP_REFERER"]))
            $this->redirect($_SERVER["HTTP_REFERER"]);
        else $this->redirect(Yii::app()->createUrl('site/index'));
	}

	/**
	 * Displays the login page
	 */
    /* Express registration, check-sending on email adresses token to activate your account */
	public function actionRapidReg()
	{
        if(isset($_POST['isExtended']))
            $model = new StudentReg('fromraptoext');
        else $model = new StudentReg('repidreg');
// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='studentreg-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
        if(isset($_POST['isExtended']))
        {
            $this->redirect( Yii::app()->createUrl('studentreg/index',array('tempEmail'=>$_POST['StudentReg']['email'],'tempPass'=>$_POST['StudentReg']['password'])));
        }
// collect user input data
		if(isset($_POST['StudentReg']))
		{
			$model->attributes=$_POST['StudentReg'];
            $getToken=rand(0, 99999);
            $getTime=date("Y-m-d H:i:s");
            $model->token=sha1($getToken.$getTime);
            if($model->validate()) {
                $model->save();
                $subject=Yii::t('activeemail','0298');
                $headers="Content-type: text/plain; charset=utf-8 \r\n" . "From: IntITA";
                $text=Yii::t('activeemail','0299').
                    " http://intita.itatests.com/index.php?r=site/AccActivation/view&token=".$model->token."&email=".$model->email;
                mail($model->email,$subject,$text,$headers);
                $this->redirect(Yii::app()->createUrl('/site/activationinfo', array('email' => $model->email)));
			}else{
                Yii::app()->user->setFlash('forminfo', Yii::t('error','0300'));
                $this->redirect(Yii::app()->request->baseUrl . '/site#form');
            }
		}

	}

    /* Activation account*/
    public function actionAccActivation($token,$email)
    {
        $model=$this->getTokenAcc($token);
        $modelemail=StudentReg::model()->findByAttributes(array('email'=>$email));
        if($model->token==$modelemail->token){
            $model->updateByPk($model->id, array('token' => null));
            $model->updateByPk($model->id, array('status' => 1));
            $this->redirect(Yii::app()->createUrl('/site/activationaccount'));
        } else{
            throw new CHttpException(404,Yii::t('exception','0237'));
        }
    }
    /* Token validation*/
    public function getTokenAcc($token)
    {
        $model=StudentReg::model()->findByAttributes(array('token'=>$token));
        if($model===null)
            throw new CHttpException(404,Yii::t('exception','0237'));
        else
            return $model;
    }

    public function actionLogin()
    {
        $model = new StudentReg('loginuser');
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='quick-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        // collect user input data
        if(isset($_POST['StudentReg']))
        {
            $model->attributes=$_POST['StudentReg'];
            $statusmodel=StudentReg::model()->findByAttributes(array('email'=>$model->email));
            // validate user input and redirect to the previous page if valid
            if($statusmodel->status==1){
                if($model->login())
                    $this->redirect(Yii::app()->request->baseUrl.'/site');
            }else $this->redirect(Yii::app()->createUrl('/site/notactivated', array('email'=>$model->email)));
        }
    }
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{

        $host = "localhost";
        $database="int_ita_db";
        $db_user = "intita";
        $password = "1234567";

        if(!mysql_connect($host,$db_user,$password))
            die('Не удалось подключиться к серверу MySql!');
        elseif(!mysql_select_db($database))
            die('Не удалось выбрать БД!');

        if (isset($_COOKIE['user_id_transition'])) {
            $siu = $_COOKIE['user_id_transition'];

            $sql = "DELETE FROM phpbb_sessions WHERE session_user_id =" . $siu . ";";
            mysql_query($sql);
            mysql_close();

//        unset($_COOKIE["user_id_transition"]);
            setCookie("user_id_transition", null, time() - 10, "/");
        }
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionSocialLogin()
    {
        $model = new StudentReg();

        $s = file_get_contents('http://ulogin.ru/token.php?token=' .$_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($s, true);
        $model->email=$user['email'];
        if($model->socialLogin())
            $this->redirect(Yii::app()->request->baseUrl.'/site');
        else {
            if(isset($user['first_name'])) $model->firstName=$user['first_name'];
            if(isset($user['last_name'])) $model->secondName=$user['last_name'];
            if(isset($user['nickname'])) $model->nickname=$user['nickname'];
            if(isset($user['bdate'])) $model->birthday=$user['bdate'];
            if(isset($user['phone'])) $model->phone=$user['phone'];
            if(isset($user['photo_big'])) {
                $arrContextOptions=array(
                    "ssl"=>array(
                        "verify_peer"=>false,
                        "verify_peer_name"=>false,
                    ),
                );
                $filesName=uniqid().'.jpg';
                file_put_contents(Yii::getpathOfAlias('webroot')."/images/avatars/".$filesName, file_get_contents($user['photo_big'], false, stream_context_create($arrContextOptions)));
                $model->avatar=$filesName;
            }
            if(isset($user['city'])) $model->address=$user['city'];
            if(isset($user['network'])){
                switch ($user['network']){
                    case 'facebook':
                        $model->facebook=$user['profile'];
                        break;
                    case 'googleplus':
                        $model->googleplus=$user['profile'];
                        break;
                    case 'linkedin':
                        $model->linkedin=$user['profile'];
                        break;
                    case 'vkontakte':
                        $model->vkontakte=$user['profile'];
                        break;
                    case 'twitter':
                        $model->twitter=$user['profile'];
                        break;
                    default:
                        break;
                }
            }
            $model->status = 1;
            if($model->validate()) {
                $model->save();
                $model = new StudentReg();
                $model->email=$user['email'];
                if($model->socialLogin())
                    $this->redirect(Yii::app()->request->baseUrl.'/site');
            }
        }
    }
    /* Checking the existence of a token  and lifetime*/
    public function getToken($token)
    {
        $time=date("Y-m-d H:i:s");
        $model=StudentReg::model()->findByAttributes(array('token'=>$token));
        if($model===null)
            throw new CHttpException(404,Yii::t('exception','0237'));
        elseif(strtotime($time)-strtotime($model->activkey_lifetime)>1800){
            $model->updateByPk($model->id, array('token' => null));
            $model->updateByPk($model->id, array('activkey_lifetime' => null));
            throw new CHttpException(404,Yii::t('exception','0238'));
        }
        else
        return $model;
    }

    /* Change password if token true*/
    public function actionVerToken($token)
    {
        $model=$this->getToken($token);
        $model->setScenario('recoverypass');
        if(isset($_POST['ajax']) && $_POST['ajax']==='changep-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if(Yii::app()->request->getPost('StudentReg'))
        {
            $post=Yii::app()->request->getPost('StudentReg');
            if($model->token==Yii::app()->request->getPost('tokenhid')){
                $model->attributes=Yii::app()->request->getPost('StudentReg');
                $model->password=$post['new_password'];
                $model->token=null;
                $model->activkey_lifetime=null;
                if($model->validate()) {
                    $model->save();
                    $modellogin = new StudentReg('loginuser');
                    $modellogin->password=$post['new_password'];
                    $modellogin->email=$model->email;
                    if(Yii::app()->user->isGuest && $modellogin->login())
                        $this->redirect(Yii::app()->createUrl('site/index'));
                    else $this->redirect(Yii::app()->createUrl('studentreg/edit'));
                }
            }
        } else{
            $this->render('resetpass',array(
                'model'=>$model,
            ));
        }
    }
    public function actionVerEmail($token,$email)
    {
        $model=$this->getToken($token);
        if($model)
        {
            $model->updateByPk($model->id, array('email' => $email));
            $model->updateByPk($model->id, array('token' => null));
            $model->updateByPk($model->id, array('activkey_lifetime' => null));
            if(Yii::app()->user->isGuest && $model->login())
            $this->redirect(Yii::app()->createUrl('/site/resetemailinfo'));
            else $this->redirect(Yii::app()->createUrl('/site/resetemailinfo'));
        }
        else{
            $this->render('resetpass',array(
                'model'=>$model,
            ));
        }
    }
    public function actionRecoveryPass()
    {
        $model = new StudentReg('recovery');
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='recovery-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        // collect user input data
        $model->attributes=Yii::app()->request->getPost('StudentReg');
        $getModel= StudentReg::model()->findByAttributes(array('email'=>$model->email));
        if(Yii::app()->request->getPost('StudentReg'))
            {
                $getToken=rand(0, 99999);
                $getTime=date("Y-m-d H:i:s");
                $getModel->token=sha1($getToken.$getTime);
            }
        if($getModel->validate())
        {
            $subject=Yii::t('recovery','0281');
            $headers="Content-type: text/plain; charset=utf-8 \r\n" . "From: IntITA";
            $text=Yii::t('recovery','0239').
                " http://intita.itatests.com/index.php?r=site/vertoken/view&token=".$getModel->token;
            $getModel->updateByPk($getModel->id, array('token' => $getModel->token,'activkey_lifetime' => $getTime));
            mail($getModel->email,$subject,$text,$headers);
            $this->redirect(Yii::app()->createUrl('/site/resetpassinfo', array('email' => $model->email)));
        }
    }
    public function actionResetEmail()
    {
        if(!Yii::app()->user->isGuest){
            $model=StudentReg::model()->findByPk(Yii::app()->user->id);
            $modelReset = new StudentReg('resetemail');
            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']==='resetemail-form')
            {
                echo CActiveForm::validate($modelReset);
                Yii::app()->end();
            }
            // collect user input data
            $modelReset->attributes=Yii::app()->request->getPost('StudentReg');
            if(Yii::app()->request->getPost('StudentReg'))
            {
                $getToken=rand(0, 99999);
                $getTime=date("Y-m-d H:i:s");
                $model->token=sha1($getToken.$getTime);
            }
            if($model->validate())
            {
                $subject=Yii::t('recovery','0282');
                $headers="Content-type: text/plain; charset=utf-8 \r\n" . "From: IntITA";
                $text=Yii::t('recovery','0283').
                    " http://intita.itatests.com/index.php?r=site/veremail/view&token=".$model->token."&email=".$modelReset->email;
                $model->updateByPk($model->id, array('token' => $model->token,'activkey_lifetime' => $getTime));
                mail($modelReset->email,$subject,$text,$headers);
                $this->redirect(Yii::app()->createUrl('/site/changeemailinfo', array('email' => $modelReset->email)));
            }
        }
    }

    public function actionActivationinfo($email)
    {
        $this->render('activationinfo',array(
            'email'=>$email,
        ));
    }
    public function actionChangeemailinfo($email)
    {
        $this->render('changeemailinfo',array(
            'email'=>$email,
        ));
    }
    public function actionResetpassinfo($email)
    {
        $this->render('resetpassinfo',array(
            'email'=>$email,
        ));
    }
    public function actionResetemailinfo()
    {
        $this->render('resetemail');
    }
    public function actionNotactivated($email)
    {
        $this->render('notactivated',array(
            'email'=>$email,
        ));
    }
    public function actionActivationaccount()
    {
        $this->render('activationaccount');
    }
}
