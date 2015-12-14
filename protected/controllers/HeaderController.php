<?php

class HeaderController extends Controller
{
//    public function filters()
//    {
//        return array(
//            array(
//                'COutputCache',
//                'duration'=> 60,
//            ),
//        );
//    }

	public function actionIndex()
	{
		$this->render('index');
	}
}