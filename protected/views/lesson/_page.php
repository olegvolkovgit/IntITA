<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 04.12.2015
 * Time: 13:43
 */
if (isset($_COOKIE['lessonTab'])) $lessonTab = $_COOKIE['lessonTab']; else $lessonTab = 0;
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
        'active' => $lessonTab,
    ),
    'id' => 'MyTab-Menu',
));
//}
?>
<!--modal task congratulations-->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog2',
    'themeUrl' => Config::getBaseUrl() . '/css',
    'cssFile' => 'jquery-ui.css',
    'theme' => 'my',
    'options' => array(
        'autoOpen' => false,
        'modal' => true,
        'resizable' => false,
    ),
));
    $this->renderPartial('/lesson/_partCompleteDialog');
    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!--modal task dialogInfo-->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'informDialog',
    'themeUrl' => Config::getBaseUrl() . '/css',
    'cssFile' => 'jquery-ui.css',
    'theme' => 'my',
    'options' => array(
        'autoOpen' => false,
        'modal' => true,
        'resizable' => false,
    ),
));
?>
<div>
    <p style="text-align: center"><?= Yii::t('lesson', '0793'); ?></p>
    <div class="modalBody">
        <a class="modalButton" ng-click="hideInformDialog()" ui-sref="{{'page({page: nextPage() || (lastAccessPage+1)})'}}" ><?php echo Yii::t('lecture', '0681'); ?></a>
    </div>
</div>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
