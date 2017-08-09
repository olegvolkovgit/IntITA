<?php

class m170703_133205_update_module_progress_for_users extends CDbMigration
{
    public function safeUp()
    {
        $modulesId=array();
        foreach (Course::model()->findByPk(1)->module as $module) {
            array_push($modulesId, $module->moduleInCourse->module_ID);
        }

        $ids = join("','",$modulesId);
        $sql = "SELECT service_id FROM acc_module_service WHERE module_id IN ('$ids')";
        $services = Yii::app()->db->createCommand($sql)->queryAll();

        $servicesModuleId=array();
        foreach ($services as $service) {
            array_push($servicesModuleId, $service['service_id']);
        }
        $servicesCourseId=array('1','26');

        $groupStudentsByModule = Yii::app()->db->createCommand()
            ->selectDistinct('s.id_user, m.module_ID')
            ->from('offline_students s')
            ->join('offline_subgroups sg', 'sg.id=s.id_subgroup')
            ->join('offline_groups g', 'g.id=sg.group')
            ->join('group_access_to_content ga', 'ga.group_id=g.id')
            ->join('acc_module_service ms', 'ms.service_id=ga.service_id')
            ->join('module m', 'm.module_ID=ms.module_id')
            ->order('s.id_user asc')
            ->where(array(
                'and',
                's.end_date is NULL',
                array('in', 'ga.service_id', $servicesModuleId)
            ), array())
            ->getText();

        $groupStudentsWithByCourse = Yii::app()->db->createCommand()
            ->selectDistinct('s.id_user, m.module_ID')
            ->from('offline_students s')
            ->join('offline_subgroups sg', 'sg.id=s.id_subgroup')
            ->join('offline_groups g', 'g.id=sg.group')
            ->join('group_access_to_content ga', 'ga.group_id=g.id')
            ->join('acc_course_service cs', 'cs.service_id=ga.service_id')
            ->join('course_modules cm', 'cm.id_course=cs.course_id')
            ->join('module m', 'm.module_ID=cm.id_module')
            ->where(array(
                'and',
                's.end_date is NULL',
                array('in', 'ga.service_id', $servicesCourseId)
            ), array())
            ->union($groupStudentsByModule)
            ->queryAll();

        foreach($groupStudentsWithByCourse as $key=>$item){

            $module=Module::model()->findByPk($item['module_ID']);
            if($module->getModuleStartTime($item['id_user'])){
                $moduleRating = RatingUserModule::model()->find('id_user=:user AND id_module=:idModule',[':user'=>$item['id_user'],':idModule'=>$item['module_ID']]);
                if (!$moduleRating){
                    $moduleRating = new RatingUserModule();
                    $moduleRating->id_user = $item['id_user'];
                    $moduleRating->id_module = $item['module_ID'];
                    $revisionModule=RevisionModule::model()->with(['properties'])->find('id_module=:module AND id_state=:activeState',
                        [':module'=>$item['module_ID'],':activeState'=>RevisionState::ReleasedState]);
                    $moduleRating->module_revision = $revisionModule?$revisionModule->id_module_revision:1;
                    $moduleStartDate=$module->getModuleStartTime($item['id_user']);
                    $moduleRating->start_module = $moduleStartDate?date("Y-m-d H:i:s",$moduleStartDate):new CDbExpression('NOW()');
                    $moduleRating->rating = 0;
                    $moduleRating->save(false);
                }
                $moduleRating->rateUser($item['id_user']);
            }
        }
    }

    public function safeDown()
    {
        $this->dropTable('rating_user_module');
    }
}