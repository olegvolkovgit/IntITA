<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 23.06.16
 * Time: 22:08
 */
class RevisionCommon {

    /**
     * @param null $idModule
     * @return array
     */
    public function getReleasedLectures($idModule = null) {

        $command = Yii::app()->db->createCommand();
        $command
            ->select('vc_lecture.*, vc_lecture_properties.*')
            ->from('vc_lecture')
            ->join('vc_lecture_properties', 'vc_lecture_properties.id = vc_lecture.id_properties')
            ->where('vc_lecture_properties.id_state = ' . RevisionState::ReadyForRelease);

        if ($idModule) {
            $command->andWhere('vc_lecture.id_module = ' . $idModule);
        }

        $data['proposed_to_release'] = $command->queryAll();

        $command = Yii::app()->db->createCommand();
        $command
            ->select('vc_lecture.*, vc_lecture_properties.*')
            ->from('vc_lecture')
            ->join('vc_lecture_properties', 'vc_lecture_properties.id = vc_lecture.id_properties')
            ->where('vc_lecture_properties.id_state = ' . RevisionState::ApprovedState);

        if ($idModule) {
            $command->andWhere('vc_lecture.id_module = ' . $idModule);
        }

        $data['approved'] = $command->queryAll();

        $command = Yii::app()->db->createCommand();
        $command
            ->select('vc_lecture.*, vc_lecture_properties.*')
            ->from('vc_lecture')
            ->join('vc_lecture_properties', 'vc_lecture_properties.id = vc_lecture.id_properties')
            ->where('vc_lecture_properties.id_state = ' . RevisionState::ReleasedState);

        if ($idModule) {
            $command->andWhere('vc_lecture.id_module = ' . $idModule);
        }

        $data['approved'] = $command->queryAll();

        return $data;
    }

    /**
     * @return array
     */
    public function getAllModules() {

        $command = Yii::app()->db->createCommand();
        $command
            ->select('module.*')
            ->from('module')
            ->where('module.status = ' . Module::READY.' and module.cancelled='.Module::ACTIVE);

        $data['ready_module'] = $command->queryAll();

        $command = Yii::app()->db->createCommand();
        $command
            ->select('module.*')
            ->from('module')
            ->where('module.status = ' . Module::DEVELOP.' and module.cancelled='.Module::ACTIVE);

        $data['develop_module'] = $command->queryAll();
        
        return $data;
    }
}