<?php

class Tenant extends Role
{
    private $errorMessage = "";
    private $dbModel;

    public function tableName()
    {
        return "user_tenant";
    }

    /**
     * @param $organization Organization
     * @return string sql for check role tenant.
     */
    public function checkRoleSql($organization=null)
    {
        $condition=$organization?' and ut.id_organization='.$organization:'';
        return 'select "tenant" from user u
                    right join chat_user as cu on u.id = cu.intita_user_id
                    right join user_tenant ut on ut.chat_user_id=cu.id
                    where cu.intita_user_id = :id and ut.end_date IS NULL'.$condition;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function title()
    {
        return "Tenant";
    }

    public function setRole(StudentReg $user, $organizationId = null)
    {
        if (!$this->isActiveTenant($user, $organizationId)) {
            if (!$this->isChatUserDefined($user)) {
                if (!$this->addChatUser($user)) {
                    $this->errorMessage = "Помилка сервера. Роль tenant не вдалось призначити.
                    Спробуйте пізніше або зверніться до адміністратора " . Config::getAdminEmail();
                    return false;
                }
            }
            $sql = 'INSERT INTO user_tenant (assigned_by, chat_user_id, id_organization) VALUES ('.Yii::app()->user->getId().', (select id from chat_user where intita_user_id='.$user->id.'), '.$organizationId.')';
            if (Yii::app()->db->createCommand($sql)->query()) {
                $this->notifyAssignRole($user, $organizationId);
                return true;
            } else {
                $this->errorMessage = "Помилка сервера. Роль tenant не вдалось призначити.
            Спробуйте пізніше або зверніться до адміністратора " . Config::getAdminEmail();
                return false;
            }
        } else {
            $this->errorMessage = "Помилка сервера. Роль tenant не вдалось призначити.
            Спробуйте пізніше або зверніться до адміністратора " . Config::getAdminEmail();
            return false;
        }
    }

    private function isChatUserDefined(StudentReg $user)
    {
        $sql = 'select COUNT(id) from chat_user where intita_user_id=' . $user->id;
        if (Yii::app()->db->createCommand($sql)->queryScalar() > 0) {
            return true;
        } else return false;
    }

    private function addChatUser($user)
    {
        $command = Yii::app()->db->createCommand();
        return $command->insert('chat_user', array(
            'nick_name' => $user->email,
            'intita_user_id' => $user->id,
        ));
    }

    public function attributes(StudentReg $user)
    {
        return array();
    }

    private function isActiveTenant(StudentReg $user, $organization)
    {
        $sql = 'select count(id) from user_tenant where chat_user_id =  (select id from chat_user where intita_user_id=' . $user->id . ') and end_date IS NULL and id_organization='.$organization;
        if (Yii::app()->db->createCommand($sql)->queryScalar() > 0) {
            $this->errorMessage = "Даному користувачу уже призначена роль tenant";
            return true;
        } else return false;
    }

    public function checkBeforeDeleteRole(StudentReg $user, $organization=null)
    {
        return true;
    }

    public function cancelAttribute(StudentReg $user, $attribute, $value)
    {
        return false;
    }

    public function addRoleFormList($query, $organization)
    {
        $criteria = new CDbCriteria();
        $criteria->select = "u.id, secondName, firstName, middleName, email, avatar";
        $criteria->alias = "u";
        $criteria->addSearchCondition('firstName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('secondName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('middleName', $query, true, "OR", "LIKE");
        $criteria->addSearchCondition('email', $query, true, "OR", "LIKE");
        $criteria->join = 'left join chat_user as cu on u.id = cu.intita_user_id';
        $criteria->join .= ' left join teacher t on t.user_id = u.id';
        $criteria->join .= ' left join teacher_organization tco on tco.id_user=u.id';
        $criteria->join .= ' left join user_tenant ut on ut.chat_user_id=cu.id';
        $criteria->addCondition('t.user_id IS NOT NULL and tco.id_user IS NOT NULL and tco.end_date IS NULL and tco.id_organization='.$organization.' 
        and (ut.chat_user_id IS NULL or ut.end_date IS NOT NULL or (ut.end_date IS NULL and ut.id_organization!='.$organization.'))');
        $criteria->group = 'u.id';
        $data = StudentReg::model()->findAll($criteria);

        $result = [];
        foreach ($data as $key => $model) {
            $result["results"][$key]["id"] = $model->id;
            $result["results"][$key]["name"] = $model->secondName . " " . $model->firstName . " " . $model->middleName;
            $result["results"][$key]["email"] = $model->email;
            $result["results"][$key]["url"] = $model->avatarPath();
        }
        return json_encode($result);
    }

    public function cancelRole(StudentReg $user, $organizationId = null)
    {
        if (!$this->checkBeforeDeleteRole($user)) {
            return false;
        }
        if (Yii::app()->db->createCommand()->
        update($this->tableName(), array(
            'end_date' => date("Y-m-d H:i:s"),
        ), 'chat_user_id=(select id from chat_user where intita_user_id=:id) and id_organization=:organization', array(':id' => $user->id,':organization'=>$organizationId))
        ) {
            $this->notifyCancelRole($user, $organizationId);
            return true;
        }
        return false;
    }

    public static function getAllPhrases()
    {
        $sql = 'select * from chat_phrases';
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $return = array('data' => array());
        if (!$result)
            return json_encode($return);
        foreach ($result as $record) {
            $row = array();

            $row["text"] = $record['text'];
            $row["id"] = $record["id"];


            array_push($return['data'], $row);
        }

        return json_encode($return);
    }

    public static function savePhrase($phrase)
    {

        $sql = "INSERT INTO `chat_phrases`(`text`) VALUES('$phrase') ";
        if (!Yii::app()->db->createCommand($sql)->query())
            return false;
        return true;


    }

    public static function editPhrase($id)
    {

        $sql = "SELECT `text` FROM `chat_phrases` WHERE id=" . $id;
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        if (!$result)
            return false;
        $rrr = $result[0];
        return strval($rrr['text']);

    }

    public static function updatePhrase($phrase, $id)
    {

        $sql = "UPDATE `chat_phrases` SET `text`='$phrase' WHERE id=" . $id;

        if (!Yii::app()->db->createCommand($sql)->query())
            return false;

        return true;

    }

    public static function deletePhrase($id)
    {

        $sql = "DELETE FROM `chat_phrases` WHERE id=" . $id;

        if (!Yii::app()->db->createCommand($sql)->query())
            return false;

        return true;

    }

    public static function getListOfMessagesBetweenUsers($id)
    {
        return true;
    }

    public static function getListOfChatsBetweenUsers($author, $user)
    {
        $return = array('data' => array());
        if($author && $user){
            $sql = "SELECT `id` FROM `chat_user` WHERE `nick_name`=" . "'" . $author . "'";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            if (!$result)
                return json_encode($return);
            $arr1 = $result[0];

            $sql2 = "SELECT `id` FROM `chat_user` WHERE `nick_name`=" . "'" . $user . "'";
            $result2 = Yii::app()->db->createCommand($sql2)->queryAll();
            if (!$result2)
                return json_encode($return);
            $arr2 = $result2[0];

            $sql5 = "SELECT ch_r.id,ch_r.name FROM `chat_room_users` as u inner join chat_room
            as ch_r on ch_r.id=u.rooms_from_users_id 
            where `ch_r`.`author_id`=" . "'" . $arr1['id'] . "'" . " and `u`.`users_id`=" . "'" . $arr2['id'] . "'";
            $result3 = Yii::app()->db->createCommand($sql5)->queryAll();
            if (!$result3)
                return json_encode($return);
        }else if($author){
            $sql = "SELECT `id` FROM `chat_user` WHERE `nick_name`=" . "'" . $author . "'";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            if (!$result)
                return json_encode($return);
            $arr1 = $result[0];

            $sql5 = "SELECT ch_r.id,ch_r.name FROM `chat_room` as ch_r where `ch_r`.`author_id`=" . "'" . $arr1['id']. "'";
            $result3 = Yii::app()->db->createCommand($sql5)->queryAll();
            if (!$result3)
                return json_encode($return);
        }else if($user){
            $sql2 = "SELECT `id` FROM `chat_user` WHERE `nick_name`=" . "'" . $user . "'";
            $result2 = Yii::app()->db->createCommand($sql2)->queryAll();
            if (!$result2)
                return json_encode($return);
            $arr2 = $result2[0];

            $sql5 = "SELECT ch_r.id,ch_r.name FROM `chat_room_users` as u inner join chat_room as ch_r
            on ch_r.id=u.rooms_from_users_id where `u`.`users_id`=" . "'" . $arr2['id'] . "'";
            $result3 = Yii::app()->db->createCommand($sql5)->queryAll();
            if (!$result3)
                return json_encode($return);
        }


        foreach ($result3 as $record) {
            $row = array();
            $row["name"]["title"] = $record['name'];
//            $row["name"]["url"] = Yii::app()->createUrl("crmChat").'#/dialog_view/'.$record['id'].'/';
            $row["name"]["id"] = $record['id'];

            array_push($return['data'], $row);

        }
        return json_encode($return);

    }

    function getMembers($criteria = null)
    {
        return UserTenant::model()->with('user')->findAll($criteria);
    }

    public function getOrganizations()
    {
        return Yii::app()->db->createCommand()
            ->selectDistinct('id_organization')
            ->from($this->tableName())
            ->where('chat_user_id=(select id from chat_user where intita_user_id=:id) and end_date IS NULL', array(':id'=>Yii::app()->user->model->registrationData->id))
            ->queryAll();
    }
}