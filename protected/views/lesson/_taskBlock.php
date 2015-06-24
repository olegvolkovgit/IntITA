<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:43
 */
?>
<div class="element">
    <?php $this->renderPartial('_editToolbar', array(
        'idLecture' => $data['id_lecture'],
        'order' =>  $data['block_order'],
        'editMode' => $editMode,
    ));?>

<div class="lessonTask">
    <img class="lessonBut" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'lessButton.png'); ?>">
    <div class="lessonButName" unselectable = "on"><?php echo Yii::t('lecture','0086'); ?></div>
    <div class="lessonLine"></div>
    <div class="lessonBG">
        <div class="instrTaskImg">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'task.png'); ?>">
        </div>
        <div class="content">
        <div class="instrTaskText" id="<?php echo "t" . $data['block_order'];?>" onclick="function(){order = this.id;}">
            <ol>
                <?php echo $data['html_block'];?>
            </ol>
            </div>
            <form action="http://ii.itatests.com" method="post" class="sendAnswer">
                <input type="hidden" name="task" >
                <input type="hidden" name="lang" value="c">
                <textarea name="code" > </textarea>
                <input name="send" id="taskSubmit" type="submit" value="<?php echo Yii::t('lecture','0089'); ?>" data-vars="<?=$data['id_lecture']?>">
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