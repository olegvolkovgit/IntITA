<?php
// Temp Controller for test  will be remove in future

class RateController extends Controller
{
	public function actionRate()
	{
        $start = microtime(true);
		$rating = RatingUserModule::model()->find('id_user = 740');
		$rating->rateUser(740);
        $time = microtime(true) - $start;
        printf('Скрипт выполнялся %.4F сек.', $time);

        $start = microtime(true);
        $rating = RatingUserCourse::model()->find('id_user = 740');
        $rating->rateUser(740);
        $time = microtime(true) - $start;
        printf('Скрипт выполнялся %.4F сек.', $time);
	}

}
