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
        'editMode' => $editMode,
    ));?>

<div class="lessonTask">
    <img class="lessonButFinal" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'lessButtonFinale.png'); ?>">
    <div class="lessonButFinal" unselectable = "on"><?php echo Yii::t('lecture','0090'); ?></div>
    <div class="lessonLine"></div>
    <div class="lessonBG">
        <div class="instrTaskImg">
            <img src="<?php echo LectureHelper::getTaskIcon($user, $data['id_block'], $editMode);?>">
        </div>
        <div class="content">
            <div class="instrTaskText" id="<?php echo "t" . $data['block_order'];?>" onclick="function(){order = this.id;}">
                <?php echo $data['html_block'];?>
            </div>
            <form onclick="sendTaskAnswer()" method="post" class="sendAnswer">
                <textarea name="code<?php echo $data['block_order'];?>" > </textarea>

                <button class="taskSubmit" <?php if ($user == 0 || $editMode) echo " disabled";?>
                        onclick="sendTaskAnswer(
                        <?php echo $user;?>,'code<?php echo $data['block_order'];?>',
                        <?php echo LectureHelper::getTaskId($data['id_block']);?>,
                            '<?php echo LectureHelper::getTaskLang($data['id_block']);?>');">
                    <?php echo Yii::t('lecture','0089'); ?>
                </button>
            </form>
        </div>
    </div>
</div>
</div>

<?php
// use editor WYSIWYG Imperavi
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

<script type="text/javascript">
    function sendTaskAnswer() {
        JSONRequest.post(
            "http://ii.itatests.com",
            {
                "operation" : "status",
                "session" : "123456789044241232",
                "jobid" : 1
            },
            function (requestNumber, value, exception) {
                alert(value);
            }
        );
    }
</script>

