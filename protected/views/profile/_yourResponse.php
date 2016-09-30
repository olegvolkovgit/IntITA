<script>
    idTeacher='<?php echo $model->primaryKey ?>';
    basePath = '<?php echo Config::getBaseUrl(); ?>';
    min = '<?=Config::getMinLengthResponse()?>';
    max = '<?=Config::getMaxLengthResponse()?>';
    minMsg='<?php echo Yii::t("response", "0820", array('{min}' => Config::getMinLengthResponse())) ?>';
    maxMsg='<?php echo Yii::t("response", "0821", array('{max}' => Config::getMaxLengthResponse())) ?>';
</script>
<?php if (!Yii::app()->user->isGuest && Yii::app()->user->model->canAddResponse($model->primaryKey)) { ?>
    <div class="lessonTask">
        <img class="lessonBut"
             src="<?php echo StaticFilesHelper::createPath('image', 'teachers', 'lessButton.png'); ?>">

        <div class="lessonButName" unselectable="on"><?php echo Yii::t('teacher', '0187'); ?></div>
        <div class="lessonLine"></div>
        <div class="responseBG">
            <div>
                <table style="padding-left: 35px; padding-top: 30px;">
                    <tr>
                        <td align="right">
                            <b><?php echo Yii::t('teacher', '0188'); ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <?php echo Yii::t('teacher', '0189'); ?>
                        </td>
                        <td>
                            <div id="material"></div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <?php echo Yii::t('teacher', '0190'); ?>
                        </td>
                        <td>
                            <div id="behavior"></div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <?php echo Yii::t('teacher', '0191'); ?>
                        </td>
                        <td>
                            <div id="motiv"></div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="BBCode">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'response-form',
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array(
                        'enctype' => 'multipart/form-data',
                        'ng-controller'=>'teacherResponse'
                    ),
                )); ?>
                <div class="row">
                    <?php echo $form->hiddenField($response, 'knowledge', array('id' => 'rat1', 'ng-model'=>'knowledge')); ?>
                </div>
                <div class="row">
                    <?php echo $form->hiddenField($response, 'behavior', array('id' => 'rat2','ng-model'=>'behavior')); ?>
                </div>
                <div class="row">
                    <?php echo $form->hiddenField($response, 'motivation', array('id' => 'rat3', 'ng-model'=>'motivation')); ?>
                </div>
                <div class="row">
                    <?php echo $form->textArea($response, 'text', array('class' => 'editor', 'id' => 'go')); ?>
                </div>
                <div class="rowbuttons">
                    <input id='sendResponse' type="button" ng-click="sendResponse()" value="<?php echo Yii::t('teacher', '0192') ?>">
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
<?php } ?>
<script type="text/javascript">
    $.fn.raty.defaults.path = "<?php echo Config::getBaseUrl(); ?>/images/rating/";
</script>