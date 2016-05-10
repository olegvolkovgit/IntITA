<?php
    $knowldg = '0';
    $behvr = '0';
    $motivtn = '0';
    $knowval = Null;
    $behval = Null;
    $motivval = Null;
?>
<?php if (!Yii::app()->user->isGuest && Yii::app()->user->model->canAddResponse()) { ?>
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
                    'action' => Yii::app()->createUrl('profile/index', array('idTeacher' => $model->primaryKey)),
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                )); ?>
                <div class="row">
                    <?php echo $form->hiddenField($response, 'knowledge', array('id' => 'rat1', 'value' => $knowval)); ?>
                </div>
                <div class="row">
                    <?php echo $form->hiddenField($response, 'behavior', array('id' => 'rat2', 'value' => $behval)); ?>
                </div>
                <div class="row">
                    <?php echo $form->hiddenField($response, 'motivation', array('id' => 'rat3', 'value' => $motivval)); ?>
                </div>

                <div class="row">
                    <?php echo $form->textArea($response, 'text', array('class' => 'editor', 'id' => 'go')); ?>
                </div>
                <div class="modelerrors">
                    <?php if ($form->error($response, 'knowledge') || $form->error($response, 'behavior') || $form->error($response, 'motivation'))
                        echo Yii::t('response', '0385'); ?>
                    <?php echo $form->error($response, 'text'); ?>
                </div>
                <div class="rowbuttons">
                    <?php echo CHtml::submitButton(Yii::t('teacher', '0192'), array('id' => "sendResponse")); ?>
                </div>
                <?php if (Yii::app()->user->hasFlash('messageResponse')):
                    echo Yii::app()->user->getFlash('messageResponse');
                endif; ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
<?php } ?>
<script type="text/javascript">

    $.fn.raty.defaults.path = "<?php echo Config::getBaseUrl(); ?>/images/rating/";

    $('#material').raty({
        score: <?php echo $knowldg; ?>,
        click: function (score) {
            document.getElementById('rat1').value = score;
        }
    });

    $('#behavior').raty({
        score: <?php echo $behvr; ?>,
        click: function (score) {
            document.getElementById('rat2').value = score;
        }
    });
    $('#motiv').raty({
        score: <?php echo $motivtn; ?>,
        click: function (score) {
            document.getElementById('rat3').value = score;
        }
    });

    $(document).ready(function () {
        $('#sendResponse').tooltip();
        document.getElementById('sendResponse').disabled = true;
        document.getElementById('sendResponse').setAttribute('title','<?php echo Yii::t("response", "0820", array('{min}'=>Config::getMinLengthResponse())) ?>');
        min = <?=Config::getMinLengthResponse()?>;
        max = <?=Config::getMaxLengthResponse()?>;
        $('html').on('keydown', '.wysibb-text-editor', function () {
//            content = $(this);
            $(this).keyup(function(e){ check_charcount($(this), max, min, e); });
            $(this).keydown(function(e){ check_charcount($(this), max, min, e); });
        });
        function check_charcount(content, max, min, e) {
            tmpstr = content.text().replace(/\s/gm, '');
            if(tmpstr.length < min){
                document.getElementById('sendResponse').disabled = true;
                document.getElementById('sendResponse').setAttribute('title','<?php echo Yii::t("response", "0820", array('{min}'=>Config::getMinLengthResponse())) ?>');
            } else {
                document.getElementById('sendResponse').disabled = false;
                document.getElementById('sendResponse').removeAttribute('title');
                if(tmpstr.length > max){
                    document.getElementById('sendResponse').disabled = true;
                    document.getElementById('sendResponse').setAttribute('title','<?php echo Yii::t("response", "0821", array('{max}'=>Config::getMaxLengthResponse())) ?>');
                }
            }
            if(e.which != 8 && tmpstr.length > max)
            {
                e.preventDefault();
            }
        }
    });
</script>