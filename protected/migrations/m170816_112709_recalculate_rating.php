<?php

class m170816_112709_recalculate_rating extends CDbMigration
{


	public function safeUp()
	{
	    $this->addColumn('rating_user_module','old_rating','DOUBLE');
	    $this->update('rating_user_module',['old_rating'=> new CDbExpression('rating')]);
	    $moduleRating = RatingUserModule::model()->findAll('module_revision > 1 AND module_done = 1');
	    foreach ($moduleRating as $rating){
	        $rating->module_done = 0;
	        $rating->rateUser($rating->id_user);
        }
	}

	public function safeDown()
	{
	echo "m170816_112709_recalculate_rating does not support migration down.\n";
        $this->update('rating_user_module',['rating'=> new CDbExpression('old_rating')]);
	    $this->dropColumn('rating_user_module','old_rating');
		return true;
	}
}