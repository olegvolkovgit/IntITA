<?php

class Consultant extends Role
{
    private $dbModel;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_consultant';
	}

	/**
	 * @return string the role title (ua)
	 */
	public function title(){
		return 'Консультант';
	}

	public function attributes(StudentReg $user)
	{
		$records = Yii::app()->db->createCommand()
			->select('module, m.title_ua')
			->from('consultant_modules cm')
            ->join('module m', 'm.module_ID=cm.module')
			->where('consultant=:id', array(':id'=>$user->id))
			->queryAll();

		$list = [];
        foreach($records as $record){
            $row["id"] =  $record['module'];
            $row["title"] =  $record['title_ua'];
            array_push($list, $row);
        }

        $attribute = array(
            'key' => 'module',
            'title' => 'Модулі',
            'type' => 'module-list',
            'value' => $list
        );
        $result = [];
        array_push($result, $attribute);

		return $result;
	}
}
