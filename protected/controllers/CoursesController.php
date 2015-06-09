<?php
class CoursesController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($selector = 'all')
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'

        $criteria= new CDbCriteria;
        $criteria->alias = 'course';
        if ($selector !== 'all'){
            if ($selector == 'junior'){
                $criteria->addInCondition('level', array('intern','strong junior','junior'));
            } else {
                $criteria->condition = 'level=:level';
                $criteria->params = array(':level'=>$selector);
            }
        }

        $dataProvider = new CActiveDataProvider('Course', array(
            'criteria' => $criteria,
            'Pagination'=>false,
        ));

        $total = $dataProvider->getTotalItemCount();
        $count1 =round($total/2);
        $count2 = $total - $count1;

        $this->render('index', array(

            'dataProvider' => $dataProvider,
            'count1' => $count1,
            'count2' => $count2,
        ));
    }

}