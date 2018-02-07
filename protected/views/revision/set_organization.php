<?php
/* @var $revisionController string */
?>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'fontface.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', '/my/jquery-ui.css') ?>"/>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'authDialog',
    'themeUrl' => Config::getBaseUrl() . '/css',
    'cssFile' => 'jquery-ui.css',
    'theme' => 'my',
    'options' => array(
        'width' => 540,
        'autoOpen' => true,
        'modal' => true,
        'resizable' => false
    ),
));
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'users_organizations_list',
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
        'action' => array('revision/redirectToRevisions'),
        'htmlOptions' => array('onsubmit'=>"$('.signInEmailM').val($('.signInEmailM').val().trim())", 'name' => 'authFormDialog', 'novalidate' => true),
    ));
    ?>
    <div ng-cloak class="signIn">
        <p><b>Обери організацію під якою ти хочеш працювати</b><Br>
        <?php foreach (Yii::app()->user->model->getOrganizationsModel() as $key=>$organization) { ;?>
            <input style="outline:none;" type="radio" name="organization" <?php if($key==0) echo 'checked' ?> value="<?php echo $organization->id ?>"><?php echo $organization->name ?><Br>
        <?php } ?>
        </p>
        <input type="hidden" name="revisionController" value="<?php echo $revisionController ?>">
        <?php echo CHtml::submitButton('', array('class' => "signInButtonM", 'value'=>'Відправити')); ?>
    </div>
    <?php $this->endWidget();
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

