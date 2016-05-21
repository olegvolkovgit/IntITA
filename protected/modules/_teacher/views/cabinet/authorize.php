<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'fontface.css'); ?>"/>
<div ng-app class="authorizePage">
    <div>
        <?php echo 'Для перегляду сторінки спочатку авторизуйся' ?>
    </div>
    <?php echo $this->decodeWidgets('{{w:AuthorizationFormWidget|dialog=false;id=studentreg-form;action=../site/signInSignUp}}'); ?>
</div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'forgotpass',
    'themeUrl' => Config::getBaseUrl() . '/css',
    'cssFile' => 'jquery-ui.css',
    'theme' => 'my',
    'options' => array(
        'width' => 540,
        'autoOpen' => false,
        'modal' => true,
        'resizable' => false
    ),
));
$this->renderPartial('/cabinet/_forgotpass');
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>