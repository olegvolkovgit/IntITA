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
        return ($result) ? '+' : '';
    }

    public static function getUserName($id)
    {
        $first = StudentReg::model()->findByPk($id)->firstName;
        $second = StudentReg::model()->findByPk($id)->secondName;
        return $first . " " . $second;
    }

    public static function getRole($id)
    {
        $code = StudentReg::model()->findByPk($id)->role;
        $role = '';
        switch ($code) {
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

    public static function getResourceDescription($id)
    {
        $module = Module::model()->findByPk($id);

        return "Module" . " " . $module->module_ID . ". " . $module->title_ua;
    }

    public static function getTitles()
    {
        $criteria = new CDbCriteria();
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

    public static function getUserInfo()
    {
        $criteria = new CDbCriteria();
        $criteria->select = array('id', 'firstName', 'secondName', 'email');
        $criteria->toArray();
        $count = StudentReg::model()->count();
        $info = Studentreg::model()->findAll($criteria);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$info[$i]["id"]] = $info[$i]["email"] . "; " . $info[$i]["firstName"] . " " . $info[$i]["secondName"];
        }
        return $result;
    }

    public static function getCourses()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'course_ID';
        return Course::model()->findAll($criteria);
    }

    public static function getCourseTitles()
    {
        $criteria = new CDbCriteria();
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

    public static function getModules()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'module_ID';
        return Module::model()->findAll($criteria);
    }

    public static function getModuleTitles()
    {
        $criteria = new CDbCriteria();
        $titleParam = LectureHelper::getTypeTitleParam();
        $criteria->select = array('module_ID', $titleParam);
        $criteria->toArray();
        $count = Module::model()->count();
        $titles = Module::model()->findAll($criteria);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$titles[$i]["module_ID"]] = $titles[$i][$titleParam];
        }
        return $result;
    }

    public static function canAddResponse()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        $user = Yii::app()->user->getId();
        if (StudentReg::model()->findByPk($user)->role == 0) {
            return true;
        }
        return false;
    }

    public static function isAdmin()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        $user = Yii::app()->user->getId();
        if (StudentReg::model()->findByPk($user)->role == 3) {

            return true;
        }
        return false;
    }

    public static function isHasAccessFileShare()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        $user = Yii::app()->user->getId();
        $role = StudentReg::model()->findByPk($user)->role;
        if ($role == 3 || $role == 1) {
            return true;
        }
        return false;
    }

    public static function generateUsersList()
    {
        $users = StudentReg::model()->findAll();
        $count = count($users);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $users[$i]->id;
            $result[$i]['alias'] = $users[$i]->firstName . " " . $users[$i]->secondName . ", " . $users[$i]->email;
        }
        return $result;
    }

    public static function generateCoursesList()
    {
        $courses = Course::model()->findAll();
        $count = count($courses);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $courses[$i]->course_ID;
            $result[$i]['alias'] = CourseHelper::getCourseName($courses[$i]->course_ID);
            $result[$i]['language'] = CourseHelper::getCourseLang($courses[$i]->course_ID);
        }
        return $result;
    }

    public static function generateRolesList()
    {
        $roles = Roles::model()->findAll();
        $count = count($roles);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $roles[$i]->id;
            $result[$i]['alias'] = $roles[$i]->title_ua;
        }
        return $result;
    }

    public static function generateTeacherRolesList($id)
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'role';
        $criteria->distinct = true;
        $criteria->order = 'role';
        $criteria->condition = 'teacher=' . $id;
        $roles = TeacherRoles::model()->findAll($criteria);
        $result = [];
        for ($i = 0, $count = count($roles); $i < $count; $i++) {
            $result[$i]['id'] = $roles[$i]->role;
            $result[$i]['alias'] = Roles::model()->findByPk($roles[$i]->role)->title_ua;
        }
        return $result;
    }

    public static function generateModulesList()
    {
        $modules = Module::model()->findAll();
        $count = count($modules);
        $result = [];
        $titleParam = LectureHelper::getTypeTitleParam();
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $modules[$i]->module_ID;
            $result[$i]['alias'] = $modules[$i]->$titleParam;
        }
        return $result;
    }

    public static function generateLecturesList($module = 1)
    {
        $lectures = Lecture::model()->findAllByAttributes(array('idModule' => $module));
        $count = count($lectures);
        $result = [];
        $titleParam = LectureHelper::getTypeTitleParam();
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $lectures[$i]->id;
            $result[$i]['alias'] = $lectures[$i]->$titleParam;
        }
        return $result;
    }

    public static function canAddConsultation()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        $user = Yii::app()->user->getId();
        if (StudentReg::model()->findByPk($user)->role == 0) {
            return true;
        }
        return false;
    }

    public static function generateTeachersList()
    {
        $teachers = Teacher::model()->findAll();
        $count = count($teachers);
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[$i]['id'] = $teachers[$i]->teacher_id;
            $result[$i]['alias'] = $teachers[$i]->first_name . " " . $teachers[$i]->last_name . ", " . $teachers[$i]->email;
        }
        return $result;
    }

    public static function accesModule($id)
    {
        if (Yii::app()->user->isGuest) {
            return false;
        }
        if (AccessHelper::isAdmin()) {
            return true;
        }
        if (AccessHelper::getRole(Yii::app()->user->getId()) == 'викладач') {
            if (TeacherHelper::isTeacherAuthorModule(Yii::app()->user->getId(), $id))
                return true;
        }
        $modulePermission = new PayModules();
        if (!$modulePermission->checkModulePermission(Yii::app()->user->getId(), $id, array('read'))) {
            return false;
        }
        return true;
    }

    public static function moduleAccessStyle($data)
    {
        $user=Yii::app()->user->getId();
        if (Yii::app()->user->isGuest) {
            return 'disableModuleStyle';
        }
        if (AccessHelper::isAdmin()) {
            return 'availableModuleStyle';
        }
        if (AccessHelper::getRole($user) == 'викладач') {
            if (TeacherHelper::isTeacherAuthorModule($user, $data->moduleInCourse->module_ID))
                return 'availableModuleStyle';
        }
        if(PayCourses::model()->checkCoursePermission($user, $data->id_course, array('read'))){
            switch (ModuleHelper::getModuleProgress($data->moduleInCourse->module_ID, $user)[0]) {
                case 'inline':
                    return 'inlineModuleStyle';
                    break;
                case 'inProgress':
                    return 'inProgressModuleStyle';
                    break;
                case 'finished':
                    return 'inFinishedModuleStyle';
                    break;
                default:
                    return 'inlineModuleStyle';
                    break;
            }
        }
        $modulePermission = new PayModules();
        if (!$modulePermission->checkModulePermission($user, $data->moduleInCourse->module_ID, array('read'))) {
            return 'disableModuleStyle';
        }
        return 'availableModuleStyle';
    }
    public static function moduleProgressDescription($data,$value)
    {
        $user=Yii::app()->user->getId();
        $time=ModuleHelper::getAverageModuleDuration($data->moduleInCourse->lesson_count,$data->moduleInCourse->hours_in_day,$data->moduleInCourse->days_in_week);
        if (Yii::app()->user->isGuest) {
            $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'disabled.png'));
            return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.CommonHelper::getDaysTermination($time).$img.'</div>', Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)), array('class' => 'disableModule'));
        }
        if (AccessHelper::isAdmin()) {
            return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.CommonHelper::getDaysTermination($time).'</div>', Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
        }
        if (AccessHelper::getRole(Yii::app()->user->getId()) == 'викладач') {
            if (TeacherHelper::isTeacherAuthorModule(Yii::app()->user->getId(), $data->moduleInCourse->module_ID))
                return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.CommonHelper::getDaysTermination($time).'</div>', Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
        }

        if(PayCourses::model()->checkCoursePermission(Yii::app()->user->getId(), $data->id_course, array('read'))){
            if(ModuleHelper::getModuleProgress($data->moduleInCourse->module_ID, $user)){
                $moduleInfo=ModuleHelper::getModuleProgress($data->moduleInCourse->module_ID, $user);
                switch ($moduleInfo[0]) {
                    case 'inline':
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'future.png'));
                        return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.CommonHelper::getDaysTermination($time).'. '.Yii::t('module', '0648').$img.'</div>', Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
                        break;
                    case 'inProgress':
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'inProgress.png'));
                        return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.CommonHelper::getDaysTermination($time).'. '.Yii::t('module', '0650').' '.$moduleInfo[1].' '.CommonHelper::getDaysTermination($moduleInfo[1]).'. '.Yii::t('module', '0651').$img.'</div>', Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
                        break;
                    case 'finished':
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'finished.png'));
                        return CHtml::link($value.'<div class="moduleProgress"><span class="greenFinished">'.Yii::t('module', '0649').'</span> ('.Yii::t('module', '0650').': <span class="'.ModuleHelper::getHoursColor($moduleInfo[1],$time).'">'.$moduleInfo[1].'</span> '.CommonHelper::getDaysTermination($moduleInfo[1]).' '.Yii::t('module', '0652').' '.$time.')'.$img.'</div>', Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
                        break;
                    default:
                        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'future.png'));
                        return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.CommonHelper::getDaysTermination($time).'. '.Yii::t('module', '0648').$img.'</div>', Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
                        break;
                }
            }else{
                $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'future.png'));
                return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.CommonHelper::getDaysTermination($time).'. '.Yii::t('module', '0648').$img.'</div>', Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)));
            }
        }

        $modulePermission = new PayModules();
        if (!$modulePermission->checkModulePermission(Yii::app()->user->getId(), $data->moduleInCourse->module_ID, array('read'))) {
            $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'disabled.png'));
            return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.CommonHelper::getDaysTermination($time).' '.$img.'</div>', Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)), array('class' => 'disableModule'));
        }else{
            return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.CommonHelper::getDaysTermination($time).'</div>', Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)), array('class' => ''));
        }

        $img = CHtml::image(StaticFilesHelper::createPath('image', 'module', 'disabled.png'));
        return CHtml::link($value.'<div class="moduleProgress">'.Yii::t('module', '0647').': '.$time.' '.CommonHelper::getDaysTermination($time).' '.$img.'</div>', Yii::app()->createUrl("module/index", array("idModule" => $data->moduleInCourse->module_ID, "idCourse" => $data->id_course)), array('class' => 'disableModule'));
    }
    /*Провіряємо чи доступна користувачу лекція. Якщо є попередні лекції з непройденими фінальними завданнями - то лекція не доступна
    Перевірка відбувається за допомогою зрівнювання порядку даної лекції з порядком першої лекції з фінальним завданням яке не пройдене
    Якщо $order>$enabledOrder то недоступна*/
    public static function accesLecture($id, $order, $enabledOrder)
    {
        $lecture = Lecture::model()->findByPk($id);
        $editMode = PayModules::checkEditMode($lecture->idModule, Yii::app()->user->getId());
        $user = Yii::app()->user->getId();
        if (AccessHelper::isAdmin()  || $editMode) {
            return true;
        }
        if (Yii::app()->user->isGuest) {
            return false;
        }
        if (!($lecture->isFree)) {
            if (AccessHelper::getRole($user) == 'викладач') {
                if (TeacherHelper::isTeacherAuthorModule($user, $lecture->idModule))
                    return true;
            }
            $modulePermission = new PayModules();
            if (!$modulePermission->checkModulePermission($user, $lecture->idModule, array('read')) || $order > $enabledOrder) {
                return false;
            }
        } else {
            if ($order > $enabledOrder)
                return false;
        }
        return true;
    }

    public static function LinkInMouseLine()
    {
        if (Yii::app()->user->isGuest)
            return "href='#form'";
        else return "";
    }
}
