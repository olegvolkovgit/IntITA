<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 04.12.2015
 * Time: 13:43
 */
?>
<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs' => array(
        Yii::t('lecture', '0613') => array('id' => 'video', 'content' => '<div ui-view="viewVideo"></div>'),
        Yii::t('lecture', '0614') => array('id' => 'text', 'content' => '<div ui-view="viewText"></div>'),
        Yii::t('lecture', '0659') => array('id' => 'quiz', 'content' =>  '<div ui-view="viewQuiz"></div>'),
    ),
    'options' => array(
        'collapsible' => false,
    ),
    'id' => 'MyTab-Menu',
));
?>

