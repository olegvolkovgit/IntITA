<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>
<div id="lessonHumMenu">
    <?php $this->renderPartial('/lesson/_authorizeMenu'); ?>
</div>
<div ng-app class="authorizePage">
    <div>
        <?php echo 'Для перегляду сторінки спочатку авторизуйся' ?>
    </div>
    <?php echo $this->decodeWidgets('{{w:AuthorizationFormWidget|dialog=false;id=studentreg-form;}}'); ?>
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
    $this->renderPartial('/site/_forgotpass');
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
</div>