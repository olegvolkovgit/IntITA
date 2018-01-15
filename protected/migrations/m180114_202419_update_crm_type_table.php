<?php

class m180114_202419_update_crm_type_table extends CDbMigration
{
    public function safeUp()
    {
        $this->renameColumn ('crm_task_type', 'title', 'title_ua');
        $this->renameColumn ('crm_task_type', 'description', 'title_ru');
        $this->addColumn('crm_task_type','title_en','VARCHAR(50) NOT NULL');
        $this->addColumn('crm_task_type','order','INT(3) NOT NULL');
        foreach (CrmTaskType::model()->findAll() as $key=>$type){
            $this->update('crm_task_type', array('order' => $type->id, 'title_en'=>$type->title_ua), 'id='.$type->id);
        }
    }

    public function safeDown()
    {
        $this->dropColumn('crm_task_type', 'order');
        $this->dropColumn('crm_task_type', 'title_en');
        $this->renameColumn ('crm_task_type', 'title_ua', 'title');
        $this->renameColumn ('crm_task_type', 'title_ru', 'description');
    }
}