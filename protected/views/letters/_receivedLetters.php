<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 18.06.2015
 * Time: 22:05
 */
?>
<?php $sender=StudentReg::model()->findByPk($data['sender_id']);
if($data['status']==1) $style='completed'; else $style='';
?>
<div class="letter">
    <span onclick="letterSpoiler(this)">
    <?php
    echo CHtml::ajaxLink(
    "<div class='".$style."'><span class='addressee'>".$sender->email."</span><span class='theme'>".$data['theme']."</span><span class='timeletter'>".$data['date']."</span></div>",
    Yii::app()->createUrl('letters/StatusUpdate', array('id'=>$data['id'])),
    array(
    'update'=>'#statusLetter'
    )
    );
    ?>
    </span>
    <div class="spoilerBody">
        <img src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $sender->avatar); ?>"/>
        <table class="letterinfo">
            <tr>
                <td>
                    <div><?php echo $data['date'] ?></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div><?php echo $sender->email ?></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div>Тема: <?php echo $data['theme'] ?></div>
                </td>
            </tr>
        </table>
        <div class="letterbody"><?php echo $data['text_letter'] ?></div>
    </div>
</div>