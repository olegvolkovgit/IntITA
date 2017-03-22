<?php

class Auditor extends Role
{
	private $dbModel;
    private $errorMessage = "";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_auditor';
	}

	/**
	 * @return string sql for check role admin.
	 */
	public function checkRoleSql(){
		return 'select "auditor" from user_auditor ua where ua.id_user = :id and end_date IS NULL';
	}

	/**
	 * @return string the role title (ua)
	 */
	public function title(){
		return 'Аудитор';
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

	public function checkBeforeDeleteRole(StudentReg $user){
		return true;
	}

	/**
	 * @param $query string - query from typeahead
	 * @return string - json for typeahead field in user manage page (cabinet, add)
	 */
	public function addRoleFormList($query)
	{
		$criteria = new CDbCriteria();
		$criteria->select = "id, secondName, firstName, middleName, email, avatar";
		$criteria->alias = "s";
		$criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
		$criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
		$criteria->join = 'LEFT JOIN user_auditor u ON u.id_user = s.id';
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
        return UserAuditor::model()->findAll($criteria);
    }
}
