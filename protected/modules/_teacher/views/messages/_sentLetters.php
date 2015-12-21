<?php
if(StudentReg::model()->exists('id=:user', array(':user' => $data['addressee_id']))){
$addressee=StudentReg::model()->findByPk($data['addressee_id']);
if($data['status']==1) $style='completed'; else $style='';?>
<div class="letter">
    <span onclick="myLetterSpoiler(this)">
        <a>
            <div class="<?php if($data['status']==1) echo 'completed' ?>">
                <span class="addressee"><?php echo $addressee->email ?></span><span class="theme"><?php echo $data['theme'] ?></span><span class='timeletter'><?php echo $data['date'] ?></span>
            </div>
        </a>
    </span>
    <div class="spoilerBody">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $addressee->avatar); ?>"/>
        <table class="letterinfo">
            <tr>
                <td>
                    <div><?php echo $data['date'] ?></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div><?php echo $addressee->email ?></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div><?php echo Yii::t("letter", "0527").' '.$data['theme'] ?></div>
                </td>
            </tr>
        </table>
        <div class="letterbody"><?php echo $data['text_letter'] ?></div>
        <div><?php echo Yii::t("letter", "0528"); if($data['status']==1) echo Yii::t("letter", "0529"); else echo Yii::t("letter", "0530") ?></div>
    </div>
</div>
<?php
} else return;
?>