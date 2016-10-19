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
        $counters = Course::countersBySelectors();

        if($selector=='modules'){
            $dataProvider = new CActiveDataProvider('Module', array(
                'sort' => array(
                    'defaultOrder' => 'module_ID DESC',
                ),
                'pagination' => array(
                    'pageSize' => 50,
                ),
            ));
            if (!Yii::app()->session['lg'] || Yii::app()->session['lg']=='ua')
                $lang = 'uk';
            else $lang = Yii::app()->session['lg'];

            $this->render('index', array(
                'dataProvider' => $dataProvider,
                'lang'=>$lang,
                'selector'=>$selector,
                'counters' => $counters,
            ));
        }else{
            $blocks = Course::getCoursesByLang($selector);

            $this->render('index', array(
                'selector'=>$selector,
                'blocks' => $blocks,
                'counters' => $counters,
            ));
        }
    }

}