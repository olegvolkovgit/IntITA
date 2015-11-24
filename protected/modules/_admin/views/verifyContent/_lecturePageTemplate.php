<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs' => array(
        Yii::t('lecture', '0613') => array('id' => 'video', 'content' => $this->render(
            '/lesson/_videoTab',
            array('page' => $page), true
        )),
        Yii::t('lecture', '0614') => array('id' => 'text', 'content' => $this->render(
            '/lesson/_textListTab',
            array('dataProvider' => $dataProvider, 'editMode' => 0, 'user' => $user), true
        )),
        Yii::t('lecture', '0659') => array('id' => 'quiz', 'content' => $this->render(
            '/lesson/_quiz',
            array('page' => $page, 'editMode' => 0, 'user' => $user), true
        )

        ),
    ),
    'options' => array(
        'collapsible' => true,
        'active' => $lessonTab,
    ),
    'id' => 'MyTab-Menu',
));
?>