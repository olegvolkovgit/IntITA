<?php

class CabinetController extends TeacherCabinetController
{
	public function actionIndex()
	{
		$this->render('index');
	}


    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionLogin($id)
    {
        $email = StudentReg::model()->findByPk($id)->email;
        $model = array_shift(Teacher::model()->findAllByAttributes(array('email' => $email)));

        $this->render('cabinet', array(
            'model' => $model,
        ));
    }

    private function loadModel($id)
    {
        $model =  Teacher::model()->findByPk($id);
            if(!$model)
                throw new \Psr\Log\InvalidArgumentException('Page not found');
        return $model;
    }

    public function actionModule($id)
    {
        $modules = Teacher::model()->findByPk($id)->modules;

        $this->render('moduleList',array(
           'modules' => $modules,
        ));
    }

    public function actionMyPlainTask($id)
    {

        $lectureArr = [];
        $modules = Teacher::model()->findByPk($id)->modules;
        foreach($modules as $module)
        {
            $lect = $module->lectures;
            if($lect){
                array_push($lectureArr,$lect);
            }
        }
        $lectureElementsArr = [];

        foreach($lectureArr as $lectures)
        {
            foreach($lectures as $lecture)
            {
                $lecEl = $lecture->lectureEl;
                if($lecEl)
                {
                    array_push($lectureElementsArr,$lecEl);

                }
            }
        }
        $plainTaskArr = [];

        foreach($lectureElementsArr as $lectureElements)
        {
            foreach($lectureElements as $lectureElement)
            {
                $plainTask = $lectureElement->plainTask;
                if($plainTask)
                {
                    array_push($plainTaskArr,$plainTask);
                }
            }
        }
        $this->render('plainTaskList',array(
            'plainTasks' => $plainTaskArr,
        ));


    }

    public function actionShowPlainTask($id)
    {
        $plainTask = PlainTask::model()->findByPk($id);

        $this->render('../plainTask/show',array(
            'plainTask' => $plainTask,
        ));
    }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}