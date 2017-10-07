<?php


class Accountant extends Role
{
	private $dbModel;
    private $errorMessage = "";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_accountant';
	}

    /**
     * @param $organization Organization
     * @return string sql for check role accountant.
     */
    public function checkRoleSql($organization=null){
        $condition=$organization?' and ac.id_organization='.$organization:'';
        return 'select "accountant" from user_accountant ac where ac.id_user = :id and ac.end_date IS NULL'.$condition;
    }

    /**
     * @return string the role title (ua)
     */
	public function title(){
		return Yii::t('profile','0971');
	}

    public function getErrorMessage(){
        return $this->errorMessage;
    }


    public function attributes(StudentReg $user, $organization=null)
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

    public function checkBeforeSetRole(StudentReg $user, $organization=null){
        return true;
    }

    /**
     * @param $query string - query from typeahead
     * @param $organization - query from typeahead
     * @return string - json for typeahead field in user manage page (cabinet, add)
     */
	public function addRoleFormList($query, $organization){
        $criteria = new CDbCriteria();
        $criteria->select = "s.id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "s";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'LEFT JOIN teacher t on t.user_id=s.id';
        $criteria->join .= ' LEFT JOIN teacher_organization tco on tco.id_user=s.id';
        $criteria->join .= ' LEFT JOIN user_accountant u ON u.id_user = s.id';
        $criteria->addCondition('t.user_id IS NOT NULL and tco.id_user IS NOT NULL and tco.end_date IS NULL and tco.id_organization='.$organization.' 
        and (u.id_user IS NULL or u.end_date IS NOT NULL or (u.end_date IS NULL and u.id_organization!='.$organization.'))');
        $criteria->group = 's.id ASC';

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
        return UserAccountant::model()->findAll($criteria);
    }
}
