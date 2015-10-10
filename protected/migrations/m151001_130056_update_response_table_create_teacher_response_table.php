<?php

class m151001_130056_update_response_table_create_teacher_response_table extends CDbMigration
{

    public function safeUp()
    {
        $sqlAll = "SELECT id,rate,knowledge,behavior,motivation,about,who FROM response";
        $resultAll = Yii::app()->db->createCommand($sqlAll)->queryAll();

        for ($i = 0, $count = count($resultAll); $i < $count; $i++) {
            if ($resultAll[$i]['rate'] == Null) {
                $rate = Yii::app()->db->createCommand()
                    ->select('rate')
                    ->from('response')
                    ->where('who=:who and about=:about and rate>0', array(':who' => $resultAll[$i]['who'], ':about' => $resultAll[$i]['about']))
                    ->queryScalar();
                $knowledge = Yii::app()->db->createCommand()
                    ->select('knowledge')
                    ->from('response')
                    ->where('who=:who and about=:about and knowledge>0', array(':who' => $resultAll[$i]['who'], ':about' => $resultAll[$i]['about']))
                    ->queryScalar();
                $behavior = Yii::app()->db->createCommand()
                    ->select('behavior')
                    ->from('response')
                    ->where('who=:who and about=:about and behavior>0', array(':who' => $resultAll[$i]['who'], ':about' => $resultAll[$i]['about']))
                    ->queryScalar();
                $motivation = Yii::app()->db->createCommand()
                    ->select('motivation')
                    ->from('response')
                    ->where('who=:who and about=:about and motivation>0', array(':who' => $resultAll[$i]['who'], ':about' => $resultAll[$i]['about']))
                    ->queryScalar();
                if ($rate > 0 && $knowledge > 0 && $behavior > 0 && $motivation > 0) {
                    $this->update('response', array(
                        'rate' => $rate,
                        'knowledge' => $knowledge,
                        'behavior' => $behavior,
                        'motivation' => $motivation
                    ), 'who=:who and about=:about',array(':who' => $resultAll[$i]['who'], ':about' => $resultAll[$i]['about']));
                } else {
                    $this->update('response', array(
                        'rate' => 1,
                        'knowledge' => 1,
                        'behavior' => 1,
                        'motivation' => 1
                    ), 'who=:who and about=:about',array(':who' => $resultAll[$i]['who'], ':about' => $resultAll[$i]['about']));
                }

            }
        }

        $sql = "SELECT id, about FROM response";
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        //$this->dropForeignKey('FK__user_2', 'response');
        $this->dropColumn('response', 'about');
        $this->createTable('teacher_response', array(
            'id_teacher' => 'INT(11) NOT NULL',
            'id_response' => 'INT(11) NOT NULL'
        ));
        for ($i = 0, $count = count($result); $i < $count; $i++) {
            $this->insert('teacher_response', array(
                'id_teacher' => $result[$i]['about'],
                'id_response' => $result[$i]['id']
            ));
        }
    }

    public function safeDown()
    {
        echo "Migration m151001_130056 does not support migration down.\n";
        return false;
    }

}