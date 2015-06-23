<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 18.06.2015
 * Time: 22:05
 */
?>
<?php $addressee=StudentReg::model()->findByPk($data['addressee_id']);
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
                    <div>Тема: <?php echo $data['theme'] ?></div>
                </td>
            </tr>
        </table>
        <div class="letterbody"><?php echo $data['text_letter'] ?></div>
        <div>Статус: <?php if($data['status']==1) echo 'лист прочитаний отримувачем'; else echo 'отримувач ще не прочитав листа' ?></div>
    </div>
</div>