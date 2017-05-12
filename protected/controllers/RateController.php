<?php
// Temp Controller for test  will be remove in future

class RateController extends Controller
{
	public function actionRate()
	{

		$rating = RatingUserModule::model()->findByPk(2);
		$rating->rateUser(740);
	}

}
