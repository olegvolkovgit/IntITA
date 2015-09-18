<?php
/**
 * Description of AccountancyController
 *
 * @author alterego4
 */
class AccountancyController  extends Controller
{
    public function actionIndex($courseId)
    {
        $course = Course::model()->findByPk($courseId);
        $this->render('index', array(
            'course' => $course,
        ));
    }
}