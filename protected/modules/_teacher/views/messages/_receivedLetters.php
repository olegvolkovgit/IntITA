<?php
if(StudentReg::model()->exists('id=:user', array(':user' => $data['sender_id']))){
$sender = StudentReg::model()->findByPk($data['sender_id']);
if ($data['status'] == 1) $style = 'completed'; else $style = '';
?>
<div class="letter <?php if($data['status']==1) echo 'completed' ?>">
    <span onclick="letterSpoiler(this)">
    <?php
    echo CHtml::ajaxLink(
        "<table class='letterinfo'>
            <tr>
                <td>
                    <img src='".StaticFilesHelper::createPath('image', 'avatars', $sender->avatar)."'/>
                </td>
                <td>
                    <table>
                        <tr><td><div>".$data['date']."</div></td></tr>
                        <tr><td><div>".$sender->email."</div></td></tr>
                        <tr><td><div>Тема: ".$data['theme']."</div></td></tr>
                    </table>
                </td>
            </tr>
        </table>",
        Yii::app()->createUrl('letters/StatusUpdate', array('id' => $data['id'])),
        array(
            'update' => '#statusLetter'
        )
    );
    ?>
    </span>

    <div class="spoilerBody">
        <div class="letterbody"><?php echo $data['text_letter'] ?></div>

        <div class="form">

            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'respletter-form' . $data['id'],
                'action' => Yii::app()->createUrl('letters/SendRespLetter',array('id'=>$data['id'])),
                'enableClientValidation' => true,
                'enableAjaxValidation' => true,
                'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
            )); ?>

            <div class="row">
                <?php echo $form->hiddenField($respletter, 'sender_id', array('value' => Yii::app()->user->getId())); ?>
            </div>

            <div class="row">
                <?php echo $form->hiddenField($respletter, 'addressee_id', array('value' => $data['sender_id'])); ?>
            </div>

            <div class="row">
                <?php echo $form->hiddenField($respletter, 'theme', array('value' => $data['theme'])); ?>
            </div>

            <div class="letterrow">
                <?php echo $form->textArea($respletter, 'text_letter', array('rows' => 6, 'cols' => 50, 'class' => 'letterresponse')); ?>
                <?php echo $form->error($respletter, 'text_letter'); ?>
            </div>
            <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t("letter", "0542"), array('class' => "sendletter")); ?>
            </div>

            <?php $this->endWidget(); ?>

        </div>
        <!-- form -->
    </div>
</div>
<?php
} else return;
?>