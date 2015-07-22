<!-- regform -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/modalTask.css"/>
<!-- regform end-->
<div class="mooda">
<?php
$qForm = new StudentReg;

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'mydialog2',
    'enableClientValidation' => true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
    'action' => Yii::app()->request->baseUrl.'/lesson/errorTask',
));
?>
<div  class="signIn2">
<div   id="heedd" ">
    <table>
        <tr>
            <td>
                <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'LessFinish.jpg'); ?>"></td>
            <td>
                <h1 style="">Вітаємо!</h1>
            </td>
        </tr>
    </table>

    <div class="happily">
        <p>Ти успішно вирішили завдання!</p>
        <p>Тепер ти можеш пройти до наступного матеріалу!</p>
<!--        <p id="haa">а також</p>-->
<!--        <p>Поділитися успіхом у соціальних мережах:</p>-->
    </div>
<!---->
<!--    <div style="width: 300px; margin-left: 0px;" class="image">-->
<!--        <div id="uLogin2" x-ulogin-params="display=buttons;fields=email;-->
<!--						redirect_uri=--><?php //echo Yii::app()->request->baseUrl . '/site/sociallogin' ?><!-- ">-->
<!--            <ul id="uLoginImages">-->
<!--                <li><img src="--><?php //echo StaticFilesHelper::createPath('image', 'signin', 'facebook2.png'); ?><!--"-->
<!--                         x-ulogin-button="facebook" title="Facebook"/></li>-->
<!--                <li><img src="--><?php //echo StaticFilesHelper::createPath('image', 'signin', 'googleplus2.png'); ?><!--"-->
<!--                         x-ulogin-button="googleplus" title="Google +"/></li>-->
<!--                <li><img src="--><?php //echo StaticFilesHelper::createPath('image', 'signin', 'linkedin2.png'); ?><!--"-->
<!--                         x-ulogin-button="linkedin" title="LinkedIn"/></li>-->
<!--                <li><img src="--><?php //echo StaticFilesHelper::createPath('image', 'signin', 'vkontakte2.png'); ?><!--"-->
<!--                         x-ulogin-button="vkontakte" title="Вконтакте"/></li>-->
<!--                <li><img src="--><?php //echo StaticFilesHelper::createPath('image', 'signin', 'twitter2.png'); ?><!--"-->
<!--                         x-ulogin-button="twitter" title="Twitter"/></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->

<input id="signInButtonM2" type="submit" value="ЗАКРИТИ">
</div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
</div>