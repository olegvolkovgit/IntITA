<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.05.2015
 * Time: 14:35
 */

class AccessHelper
{

    public static function getFlag($rights, $type)
    {
        $result = false;
        switch ($type) {
            case 'read':
                if ($rights &= 1 << 0)
                    $result = true;
                break;
            case 'edit':
                if ($rights &= 1 << 1)
                    $result = true;
                break;
            case 'create':
                if ($rights &= 1 << 2)
                    $result = true;
                break;
            case 'delete':
                if ($rights &= 1 << 3)
                    $result = true;
                break;
        }
        return ($result)?'+':'';
    }

    public static function getUserName($id){
        $first = StudentReg::model()->findByPk($id)->firstName;
        $second = StudentReg::model()->findByPk($id)->secondName;
        return $first." ".$second;
    }

    public static function getRole($id){
        $code = StudentReg::model()->findByPk($id)->role;
        $role = '';
        switch ($code){
            case '0':
                $role = 'студент';
                break;
            case '1':
                $role = 'викладач';
                break;
            case '2':
                $role = 'модератор';
                break;
            case '3':
                $role = 'адмін';
                break;
        }
        return $role;
    }

    public static function getResourceDescription($id){
        $module = Module::model()->findByPk($id);

        return "Module"." ".$module->module_ID.". ".$module->title_ua;
    }

    public static function getTitles(){
        $criteria =new CDbCriteria();
        $criteria->select = array('id', 'title');
        $criteria->toArray();
        $count = Lecture::model()->count();
        $titles = Lecture::model()->findAll($criteria);
        $result = [];
        for ($i = 0; $i < $count; $i++) {

            $result[$titles[$i]["id"]] = $titles[$i]["title"];
        }
        return $result;
    }

    public static function getUserInfo(){
        $criteria =new CDbCriteria();
        $criteria->select = array('id','firstName', 'secondName', 'email');
        $criteria->toArray();
        $count = StudentReg::model()->count();
        $info = Studentreg::model()->findAll($criteria);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$info[$i]["id"]] = $info[$i]["email"]."; ".$info[$i]["firstName"]." ".$info[$i]["secondName"];
        }
        return $result;
    }

    public static function setModuleAccess($idUser, $idModule, $rights){
        if (!empty($rights)){
            $criteria = new CDbCriteria();
            $criteria->select = 'id';
            $criteria->addCondition('idModule='.$idModule);
            $criteria->toArray();

            $lectures = Lecture::model()->findAll($criteria);
            $count = count($lectures);
            $model = new Permissions();
            for($i = 0; $i < $count; $i++){
                $model->setPermission($idUser, $lectures[$i]['id'], $rights);
            }
        }
    }

    public static function getCourses(){
        $criteria = new CDbCriteria();
        $criteria->select = 'course_ID';
        return Course::model()->findAll($criteria);
    }

    public static function getCourseTitles(){
        $criteria =new CDbCriteria();
        $criteria->select = array('course_ID', 'course_name');
        $criteria->toArray();
        $count = Lecture::model()->count();
        $titles = Lecture::model()->findAll($criteria);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$titles[$i]["course_ID"]] = $titles[$i]["course_name"];
        }
        return $result;
    }

    public static function getModules(){
        $criteria = new CDbCriteria();
        $criteria->select = 'module_ID';
        return Module::model()->findAll($criteria);
    }

    public static function getModuleTitles(){
        $criteria =new CDbCriteria();
        $criteria->select = array('module_ID', 'module_name');
        $criteria->toArray();
        $count = Module::model()->count();
        $titles = Module::model()->findAll($criteria);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$titles[$i]["module_ID"]] = $titles[$i]["module_name"];
        }
        return $result;
    }

    public static function canAddResponse(){
        if (Yii::app()->user->isGuest){
            return false;
        }
        $user = Yii::app()->user->getId();
        if (StudentReg::model()->findByPk($user)->role == 0){
            return true;
        }
        return false;
    }

    public static function isAdmin(){
        if (Yii::app()->user->isGuest){
            return false;
        }
        $user = Yii::app()->user->getId();
        if (StudentReg::model()->findByPk($user)->role == 3){

            return true;
        }
        return false;
    }

    public static function generateUsersList(){
        $users = StudentReg::model()->findAll();
        $count = count($users);
        $result = [];
        for($i = 0; $i < $count; $i++){
            $result[$i]['id'] = $users[$i]->id;
            $result[$i]['alias'] = $users[$i]->firstName." ".$users[$i]->secondName.", ".$users[$i]->email;
        }
        return $result;
    }

    public static function generateCoursesList(){
        $courses = Course::model()->findAll();
        $count = count($courses);
        $result = [];
        for($i = 0; $i < $count; $i++){
            $result[$i]['id'] = $courses[$i]->course_ID;
            $result[$i]['alias'] = CourseHelper::getCourseName($courses[$i]->course_ID);
        }
        return $result;
    }

    public static function generateRolesList(){
        $roles = Roles::model()->findAll();
        $count = count($roles);
        $result = [];
        for($i = 0; $i < $count; $i++){
            $result[$i]['id'] = $roles[$i]->id;
            $result[$i]['alias'] = $roles[$i]->title_ua;
        }
        return $result;
    }

    public static function generateModulesList($course=1){
        $modules = Module::model()->findAllByAttributes(array('course' => $course));
        $count = count($modules);
        $result = [];
        for($i = 0; $i < $count; $i++){
            $result[$i]['id'] = $modules[$i]->module_ID;
            $result[$i]['alias'] = $modules[$i]->module_name;
        }
        return $result;
    }

    public static function generateLecturesList($module=1){
        $lectures = Lecture::model()->findAllByAttributes(array('idModule' => $module));
        $count = count($lectures);
        $result = [];
        for($i = 0; $i < $count; $i++){
            $result[$i]['id'] = $lectures[$i]->id;
            $result[$i]['alias'] = $lectures[$i]->title;
        }
        return $result;
    }
    public static function canAddConsultation(){
        if (Yii::app()->user->isGuest){
            return false;
        }
        $user = Yii::app()->user->getId();
        if (StudentReg::model()->findByPk($user)->role == 0){
            return true;
        }
        return false;
    }

    public static function generateTeachersList(){
        $teachers = Teacher::model()->findAll();
        $count = count($teachers);
        $result = [];
        for($i = 0; $i < $count; $i++){
            $result[$i]['id'] = $teachers[$i]->teacher_id;
            $result[$i]['alias'] = $teachers[$i]->first_name." ".$teachers[$i]->last_name.", ".$teachers[$i]->email;
        }
        return $result;
    }

    public static function accesModule($id){
        if (Yii::app()->user->isGuest){
            return false;
        }
        if(AccessHelper::getRole(Yii::app()->user->getId())=='викладач'){
            if(TeacherHelper::isTeacherAuthorModule(Yii::app()->user->getId(),$id))
                return true;
        }
        $modulePermission = new PayModules();
        if (!$modulePermission->checkModulePermission(Yii::app()->user->getId(), $id, array('read'))) {
            return false;
        }
        return true;
    }
    public static function accesLecture($id){
        $lecture = Lecture::model()->findByPk($id);
        if (!($lecture->isFree)){
            if(Yii::app()->user->isGuest){
                return false;
            } else{
                if(AccessHelper::getRole(Yii::app()->user->getId())=='викладач'){
                    if(TeacherHelper::isTeacherAuthorModule(Yii::app()->user->getId(),$lecture->idModule))
                        return true;
                }
                $modulePermission = new PayModules();
                if (!$modulePermission->checkModulePermission(Yii::app()->user->getId(), $lecture->idModule, array('read'))) {
                    return false;
                }
            }
        }
        return true;
    }
    public static function LinkInMouseLine(){
        if(Yii::app()->user->isGuest)
            return "href='#form'";
        else return "";
    }
}
