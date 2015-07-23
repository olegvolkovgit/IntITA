<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/modalTask.css"/>

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
        <div   id="heedd">
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
            <p>Ти успішно пройшов(ла) тест!</p>
            <p>Тепер ти можеш пройти до наступного матеріалу!</p>
        </div>

        <input id="signInButtonM2" type="submit" value="ЗАКРИТИ">
    </div>
    <?php $this->endWidget(); ?>
</div>
