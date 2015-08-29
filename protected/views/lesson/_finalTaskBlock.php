<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 19:04
 */?>
<div class="element">
    <?php $this->renderPartial('_editToolbar',array(
        'idLecture' => $data['id_lecture'],
        'order' =>  $data['block_order'],
        'idBlock' => $data['id_block'],
        'editMode' => $editMode,
    ));?>

<div class="lessonTask">
<!--    <img class="lessonButFinal" src="--><?php //echo StaticFilesHelper::createPath('image', 'lecture', 'lessButtonFinale.png'); ?><!--">-->
<!--    <div class="lessonButFinal" unselectable = "on">--><?php //echo Yii::t('lecture','0090'); ?><!--</div>-->
<!--    <div class="lessonLine"></div>-->
    <div class="lessonBG">
        <div class="instrTaskImg">
            <img src="<?php echo LectureHelper::getTaskIcon($user, $data['id_block'], $editMode);?>">
        </div>
        <div class="content">
            <div class="instrTaskText" id="<?php echo "t" . $data['block_order'];?>" onclick="function(){order = this.id;}">
                <?php echo $data['html_block'];?>
            </div>
            <form class="sendAnswer">
                <textarea name="code<?php echo $data['block_order'];?>"  id="code<?php echo $data['block_order'];?>"> </textarea>
            </form>
                <button class="taskSubmit" <?php if ($user == 0 || $editMode) echo " disabled";?> onclick="sendTaskAnswer(
                    '<?php echo $user.date("Y-m-d-h-i-sa");?>',
                    'code<?php echo $data['block_order'];?>',
                <?php echo LectureHelper::getTaskId($data['id_block']);?>,
                    '<?php echo LectureHelper::getTaskLang($data['id_block']);?>');
                    ">
                    <?php echo Yii::t('lecture','0089'); ?>
                </button>

        </div>
    </div>
</div>
</div>
