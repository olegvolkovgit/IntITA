<?php

class SuperAdmin extends Role
{
	private $dbModel;
    private $errorMessage = "";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_super_admin';
	}

	/**
	 * @return string sql for check role admin.
	 */
	public function checkRoleSql(){
		return 'select "super_admin" from user_super_admin sa where sa.id_user = :id and sa.end_date IS NULL';
	}

	/**
	 * @return string the role title (ua)
	 */
	public function title(){
		return 'Суперадмін';
	}

    public function getErrorMessage(){
        return $this->errorMessage;
    }

    public function attributes(StudentReg $user)
	{
		return array();
	}

	public  function cancelAttribute(StudentReg $user, $attribute, $value)
	{
		return false;
	}

	public function checkBeforeDeleteRole(StudentReg $user, $organization=null){
		return true;
	}

	public function setRole(StudentReg $user, $organization)
	{
		if(Yii::app()->db->createCommand()->
		insert($this->tableName(), array(
			'id_user' => $user->id,
			'assigned_by'=>Yii::app()->user->getId()
		))){
			$this->notifyAssignRole($user);
			return true;
		}
		return false;
	}

	public function cancelRole(StudentReg $user, $organization)
	{
		if(!$this->checkBeforeDeleteRole($user)){
			return false;
		}
		if(Yii::app()->db->createCommand()->
		update($this->tableName(), array(
			'end_date'=>date("Y-m-d H:i:s"),
			'cancelled_by'=>Yii::app()->user->id
		), 'id_user=:id', array(':id'=>$user->id))){
			$this->notifyCancelRole($user);
			return true;
		}
		return false;
	}
	/**
	 * @param $query string - query from typeahead
	 * @param $organization - query from typeahead
	 * @return string - json for typeahead field in user manage page (cabinet, add)
	 */
	public function addRoleFormList($query, $organization)
	{
		$criteria = new CDbCriteria();
		$criteria->select = "id, secondName, firstName, middleName, email, avatar";
		$criteria->alias = "s";
		$criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
		$criteria->join = 'LEFT JOIN user_super_admin u ON u.id_user = s.id';
		$criteria->addCondition('u.id_user IS NULL or u.end_date IS NOT NULL');
        $criteria->group = 's.id';

		$data = StudentReg::model()->findAll($criteria);

		$result = [];
		foreach ($data as $key=>$model) {
			$result["results"][$key]["id"] = $model->id;
			$result["results"][$key]["name"] = $model->secondName . " " . $model->firstName . " " . $model->middleName;
			$result["results"][$key]["email"] = $model->email;
			$result["results"][$key]["url"] = $model->avatarPath();
		}
		return json_encode($result);
	}
	
    function getMembers($criteria = null)
    {
        return UserSuperAdmin::model()->findAll($criteria);
    }
}