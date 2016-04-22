<?php

/*@var $model TeachersTemp*/

class TeachersController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'teacherletter', 'UpdateTeacherAvatar'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $this->renderIndex(new TeacherLetter);
    }

    public function actionTeacherLetter()
    {
        $obj = new TeacherLetter;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'teacherletter-form') {
            echo CActiveForm::validate($obj);
            Yii::app()->end();
        }
        $obj->attributes = $_POST["TeacherLetter"];
        if ($obj->validate()) {
            $title = "Teacher_Work " . $obj->firstname . " " . $obj->lastname;
            $mess = "Ім'я: " . $obj->firstname . " " . $obj->lastname . "\r\n" . "Дата народження: " . $obj->age . "\r\n" . "Освіта: " . $obj->education . "\r\n" . "Телефон: " . $obj->phone . "\r\n" . "Курси які готовий викладати: " . $obj->courses;
            // $to - кому отправляем
            $to = Config::getAdminEmail();
            // функция, которая отправляет наше письмо.
            mail($to, $title, $mess, "Content-type: text/plain; charset=utf-8 \r\n" . "From:" . $obj->email . "\r\n");
            Yii::app()->user->setFlash('messagemail', Yii::t('teachers', '0564'));
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else $this->renderIndex($obj);
        //}
    }

    private function renderIndex($teacherLetter)
    {
        $dataProvider = Teacher::getTeacherAsPrint();
        $teachers = Teacher::getAllTeachersId();

        $this->render('index', array(
            'post' => $dataProvider->getData(),
            'teachers' => $teachers,
            'teacherletter' => $teacherLetter
        ));
    }
}
