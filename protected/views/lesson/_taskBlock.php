<div class="element">
    <?php $this->renderPartial('_editToolbar', array(
        'idLecture' => $data['id_lecture'],
        'order' =>  $data['block_order'],
        'editMode' => $editMode,
    ));?>

<div class="lessonTask">
<!--    <img class="lessonBut" src="--><?php //echo StaticFilesHelper::createPath('image', 'lecture', 'lessButton.png'); ?><!--">-->
<!--    <div class="lessonButName" unselectable = "on">--><?php //echo Yii::t('lecture','0086'); ?><!--</div>-->
<!--    <div class="lessonLine"></div>-->
    <div class="lessonBG">
        <div class="instrTaskImg">
            <img src="<?php echo LectureHelper::getTaskIcon($user, $data['id_block'], $editMode);?>">
        </div>
        <div class="content">
        <div class="instrTaskText" id="<?php echo "t" . $data['block_order'];?>" onclick="function(){order = this.id;}">
            <br/>
            <?php echo $data['html_block'];?>
            </div>
            <form class="sendAnswer" id="sendAnswer">
                <textarea name="code" id="code<?php echo $data['block_order'];?>"></textarea>
            </form>

            <button class="taskSubmit" <?php if ($user == 0 || $editMode) echo " disabled";?>
                    onclick="sendTaskAnswer('<?php echo $user.date("Y-m-d-h-i-sa");?>','code<?php echo $data['block_order'];?>',<?php echo LectureHelper::getTaskId($data['id_block']);?>,'<?php echo LectureHelper::getTaskLang($data['id_block']);?>')" >
                    <?php echo Yii::t('lecture','0089'); ?>
            </button>
        </div>

    </div>
</div>
</div>

<?php
if ($editMode) {
    $this->widget('ImperaviRedactorWidget', array(
        'selector' => "#",
        'options' => array(
            'imageUpload' => $this->createUrl('files/upload'),
            'lang' => 'ua',
            'toolbar' => true,
            'iframe' => true,
            'css' => 'wym.css',
        ),
        'plugins' => array(
            'fullscreen' => array(
                'js' => array('fullscreen.js',),
            ),
            'video' => array(
                'js' => array('video.js',),
            ),
            'fontsize' => array(
                'js' => array('fontsize.js',),
            ),
            'fontfamily' => array(
                'js' => array('fontfamily.js',),
            ),
            'fontcolor' => array(
                'js' => array('fontcolor.js',),
            ),
            'save' => array(
                'js' => array('save.js',),
            ),
            'close' => array(
                'js' => array('close.js',),
            ),
        ),
    ));
}
?>
