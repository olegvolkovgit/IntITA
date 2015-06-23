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
        $modules = Yii::app()->db->createCommand(array(
            'select' => array('idModule'),
            'from' => 'teacher_module',
            'where' => 'idTeacher=:id',
            'order' => 'idModule',
            'params' => array(':id' => $id),
        ))->queryAll();
        $count = count($modules);

        for($i = 0;$i < $count;$i++){
             $modules[$i]["title"] = Module::model()->findByPk($modules[$i]["idModule"])->module_name;
        }

        return (!empty($modules))?$modules:[];
    }

    public static function getTeacherName($id){
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
        $title = 'title_ua';
        return Roles::model()->findByPk($id)->$title;
    }

    public static function getTeacherAttributeValue($teacher, $attribute){
        $result = '';
        switch($attribute){
            case '1': //capacity
                $result = AttributeValue::model()->findByAttributes(array('teacher'=>$teacher, 'attribute'=>$attribute))->value;
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
            case '6'://leader's modules
                $result = TeacherHelper::getLeaderModules($teacher);
                break;
            case '7'://author's modules
                $result = TeacherHelper::getLeaderModules($teacher);
                break;
            case '8'://leader's capacity
                $result = AttributeValue::model()->findByAttributes(array('teacher'=>$teacher, 'attribute'=>$attribute))->value;
                break;
            default:
                $result = AttributeValue::model()->findByAttributes(array('teacher'=>$teacher, 'attribute'=>$attribute))->value;
        }
        return $result;
    }

    public static function getLeaderModules($teacher){
        $modules = LeaderModules::getModulesByLeader($teacher);
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
                $result .= "<span class='attsValue'><a href='" . Yii::app()->createUrl($route, array($param => $values[$i]['id'])) .
                    "'>" . $values[$i]['title'] . "</a></span><br>";
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
}