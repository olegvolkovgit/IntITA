<?php

/**
 * Description of AccountancyController
 *
 * @author alterego4
 */
class AccountancyController extends Controller
{
    public function actionIndex($courseId)
    {
        $course = Course::model()->findByPk($courseId);

        if (isset($_GET['print'])) {
            $this->layout = false;
        }

        $this->render('index', array(
            'course' => $course,
        ));
    }
}