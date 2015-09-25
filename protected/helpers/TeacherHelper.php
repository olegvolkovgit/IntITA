<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 08.06.2015
 * Time: 18:15
 */


class TeacherHelper
{
    public static function getModulesByTeacher($id){
        $modulelist = [];
        $criteria = new CDbCriteria;
        $criteria->alias = 'teacher_modules';
        $criteria->select = 'idModule';
        $criteria->distinct = true;
        $criteria->addCondition('idTeacher=' . $id);
        $temp = TeacherModule::model()->findAll($criteria);
        for ($i = 0; $i < count($temp); $i++) {
            array_push($modulelist, $temp[$i]->idModule);
        }

        $titleParam = ModuleHelper::getModuleTitleParam();

        $criteriaData = new CDbCriteria;
        $criteriaData->alias = 'module';
        $criteriaData->addInCondition('module_ID', $modulelist, 'OR');

        $rows = Module::model()->findAll($criteriaData);

        $j=0;
        foreach ($rows as $row) {
            if ($row[$titleParam] == '')
                $title = 'title_ua';
            else $title = $titleParam;
            $module[$j]["idModule"] = $row['module_ID'];
            $module[$j]["title"] = $row[$title];
            $module[$j]["language"] = $row['language'];
            $j++;
        };

        return (!empty($module))?$module:[];
    }

    public static function getTeacherName($id){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en'  && Teacher::model()->findByPk($id)->first_name_en != ''
                && Teacher::model()->findByPk($id)->last_name_en != ''){
                return Teacher::model()->findByPk($id)->last_name_en." ".Teacher::model()->findByPk($id)->first_name_en;
            }
        }
        return Teacher::model()->findByPk($id)->last_name." ".Teacher::model()->findByPk($id)->first_name;
    }

    public static function getTeachersRoles($id){
        $roles = Yii::app()->db->createCommand()
            ->select('role')
            ->from('teacher_roles')
            ->where('teacher=:id', array(':id'=>$id))
            ->order('role DESC')
            ->queryAll();
        $result = '';
        for($i = count($roles)-1; $i > 0; $i--){
            $result .= TeacherHelper::getRoleTitle($roles[$i]['role']);
            $result .= "\r\n";
        }
        return $result;
    }

    public static function getRoleTitle($id){
        return Roles::model()->findByPk($id)->title_ua;
    }

    public static function getTeacherAttributeValue($teacher, $attribute){
        $result = '';
        switch($attribute){
            case '1': //capacity
                if (AttributeValue::model()->exists('teacher=:teacher and attribute=:attribute', array('teacher' => $teacher, 'attribute' => $attribute))) {
                    $result = AttributeValue::model()->findByAttributes(array('teacher' => $teacher, 'attribute' => $attribute))->value;
                }
                break;
            case '2': //trainer's students
                $result = TeacherHelper::getTrainerStudents($teacher);
                break;
            case '3': //consultant_modules
                $result = TeacherHelper::getConsultantModules($teacher);
                break;
            case '4':// leader's projects
                $result = TeacherHelper::getLeaderProjects($teacher);
                break;
            case '7'://leader's modules
                $result = TeacherHelper::getLeaderModules($teacher);
                break;
            case '6'://author's modules
                $result = TeacherHelper::getTeacherModules($teacher);
                break;
            case '8'://leader's capacity
                if (AttributeValue::model()->exists('teacher=:teacher and attribute=:attribute', array('teacher' => $teacher, 'attribute' => $attribute))) {
                    $result = AttributeValue::model()->findByAttributes(array('teacher' => $teacher, 'attribute' => $attribute))->value;
                }
                break;
            default:
                if (AttributeValue::model()->exists('teacher=:teacher and attribute=:attribute', array('teacher' => $teacher, 'attribute' => $attribute))) {
                    $result = AttributeValue::model()->findByAttributes(array('teacher'=>$teacher, 'attribute'=>$attribute))->value;
                }
        }
        return $result;
    }

    public static function getLeaderModules($teacher){
        $modules = LeaderModules::getModulesByLeader($teacher);
        $result = TeacherHelper::formatAttributeList($modules, 'module/index', 'idModule', true);
        return $result;
    }

    public static function getTeacherModules($teacher){
        $modules = TeacherModule::getModulesByTeacher($teacher);
        $result = TeacherHelper::formatAttributeList($modules, 'module/index', 'idModule', true);
        return $result;
    }

    /*
     * @param $values  - values array as $array['id']['title']
     * @param route - route for link to course, module etc.
     */
    public static function formatAttributeList($values, $route, $param, $isLink){
        $result = '<br>';
        $count = count($values);
        if ($isLink) {
            for ($i = 0; $i < $count; $i++) {
                if ($route != 'module/index') {
                    $result .= "<span class='attsValue'><a href='" . Yii::app()->createUrl($route, array($param => $values[$i]['id'])) .
                        "'>" . $values[$i]['title'] . "</a></span><br>";
                } else {
                    $result .= "<span class='attsValue'><a href='" . Yii::app()->createUrl($route, array(
                            $param => $values[$i]['id'],
                            'idCourse' => CourseModules::model()->findByAttributes(array('id_module' => $values[$i]['id']))->id_course)) .
                        "'>" . $values[$i]['title'] . "</a></span><br>";
                }
            }
        } else {
            for ($i = 0; $i < $count; $i++) {
                $result .= "<span class='attsValue'>".$values[$i]['title']."</span><br>";
            }
        }
        return $result;
    }

    public static function getLeaderProjects($teacher){
        $projects = Project::getProjectsByLeader($teacher);
        $result = TeacherHelper::formatAttributeList($projects, 'project/index', 'id', false);
        return $result;
    }

    public static function getTrainerStudents($teacher){
        $students = TrainerStudent::getStudentsByTrainer($teacher);
        $result = TeacherHelper::formatAttributeList($students, 'project/index', 'id', false);
        return $result;
    }

    public static function getConsultantModules($teacher){
        $modules = ConsultantModules::getModulesByConsultant($teacher);
        $result = TeacherHelper::formatAttributeList($modules, 'module/index', 'idModule', true);
        return $result;
    }

    public static function getRoleTitlesList(){
        $criteria = new CDbCriteria();
        $criteria->select = 'id, title_ua';
        $criteria->distinct = true;
        $criteria->toArray();

        $result = '';
        $titles = Roles::model()->findAll($criteria);
        for($i = 0; $i < count($titles); $i++){
            $result[$i][$titles[$i]['id']] = $titles[$i]['title_ua'];
        }
        return $result;
    }
    public static function isTeacherAuthorModule($idUser,$idModule){
        if (Teacher::model()->exists('user_id=:user_id', array(':user_id' => $idUser))) {
            $teacherId = Teacher::model()->findByAttributes(array('user_id' => $idUser));
            $author = TeacherModule::model()->findByAttributes(array('idTeacher' => $teacherId->teacher_id, 'idModule' => $idModule));
        }
        if(isset($author)) return true; else return false;
    }

    public static function getTeacherId($user){

        if ($user != 0 && Teacher::model()->exists('user_id=:user', array(':user' => $user))){
            return Teacher::model()->findByAttributes(array('user_id' => $user))->teacher_id;
        } else {
            return 0;
        }
    }

    public static function getTeacherNameByUserId($user){
        $idTeacher = TeacherHelper::getTeacherId($user);
        return TeacherHelper::getTeacherName($idTeacher);
    }
    public static function isUserTeacher($idUser){
        if (Teacher::model()->exists('user_id=:user_id', array(':user_id' => $idUser)))
            return true;
        else return false;
    }

    public static function getTeacherLastName($id){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en' && Teacher::model()->findByPk($id)->last_name_en != ''){
                return Teacher::model()->findByPk($id)->last_name_en;
            }
        }
        return Teacher::model()->findByPk($id)->last_name;
    }

    public static function getTeacherFirstName($id){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en' && Teacher::model()->findByPk($id)->first_name_en != ''){
                return Teacher::model()->findByPk($id)->first_name_en;
            }
        }
        return Teacher::model()->findByPk($id)->first_name;
    }

    public static function getTeacherMiddleName($id){
        if(isset(Yii::app()->session['lg'])){
            if(Yii::app()->session['lg'] == 'en' && Teacher::model()->findByPk($id)->middle_name_en != ''){
                return Teacher::model()->findByPk($id)->middle_name_en;
            }
        }
        return Teacher::model()->findByPk($id)->middle_name;
    }
}