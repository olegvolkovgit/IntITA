<?php

class Trainer extends Role
{
    private $capacity;
	private $dbModel;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_trainer';
	}

	/**
	 * @return string the role title (ua)
	 */
	public function title()
    {
		return 'Тренер';
	}

    /**
     * @return array attributes trainer role
     */
	public function attributes(StudentReg $user)
	{
        $record = Yii::app()->db->createCommand()
            ->select('capacity')
            ->from($this->tableName())
            ->where('id_user=:id', array(':id'=>$user->id))
            ->queryRow();

		return array(
            array(
                'key' => 'capacity',
                'title' => 'Максимальна кількість студентів',
                'type' => 'number',
                'value' => $record["capacity"]
            )
        );
	}
}
