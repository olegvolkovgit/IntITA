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
        $obj->firstname=Yii::app()->request->getPost('firstname');
        $obj->lastname=Yii::app()->request->getPost('lastname');
        $obj->age=Yii::app()->request->getPost('age');
        $obj->education=Yii::app()->request->getPost('education');
        $obj->phone=Yii::app()->request->getPost('phone');
        $obj->courses=Yii::app()->request->getPost('courses');
        $obj->email=Yii::app()->request->getPost('email');
        if ($obj->validate()) {
            $title = "Teacher_Work " . $obj->firstname . " " . $obj->lastname;
            $mess = "Ім'я: " . $obj->firstname . " " . $obj->lastname . "\r\n" . "Вік: " . $obj->age . "\r\n" . "Освіта: " . $obj->education . "\r\n" . "Телефон: " . $obj->phone . "\r\n" . "Курси які готовий викладати: " . $obj->courses;
            $to = Config::getAdminEmail();
            mail($to, $title, $mess, "Content-type: text/plain; charset=utf-8 \r\n" . "From:" . $obj->email . "\r\n");
            echo Yii::t('letter', '0914');
        } else {
            echo Yii::t('letter', '0915');
        }
    }

    private function renderIndex($teacherLetter)
    {
        $dataProvider = Teacher::getTeacherAsPrint();
        $teachers = Teacher::getAllTeachersId();
        $this->render('index', array(
            'post' => $dataProvider,
            'teachers' => $teachers,
            'teacherletter' => $teacherLetter
        ));
    }

    public function actionUpdateAjaxFilter()
    {
        $selector = $_GET["selector"];
        $string = $_GET['input'];

        $dataProvider = Teacher::getTeacherBySelector($selector, $string);

        $teacherLetter = new TeacherLetter;
        $teachers = Teacher::getAllTeachersId();
        $this->render('index', array(
            'post' => $dataProvider,
            'teachers' => $teachers,
            'teacherletter' => $teacherLetter
        ));
    }
}
