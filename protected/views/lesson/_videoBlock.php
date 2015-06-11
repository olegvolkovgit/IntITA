<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:40
 */
?>
<div class="element">
    <?php $this->renderPartial('_editToolbar', array(
        'idLecture' => $data['id_lecture'],
        'order' =>  $data['block_order'],
        'editMode' => $editMode,
    ));?>

<div class="video" id="<?php echo "t" . $data['block_order'];?>" onclick="function(){order = this.id;}">
<h3><span class="subChapter"><?php echo Yii::t('lecture', '0420');?></span></h3>
<iframe width="778" height="480" src="<?php echo $data['html_block'];?>" frameborder="0" allowfullscreen></iframe>

<!--<div class="download" id="do2">-->
<!--    <a  href="#">-->
<!--        <img style="" src="--><?php //echo StaticFilesHelper::createPath('image', 'lecture', '000zav-se-vid.png'); ?><!--">-->
<!--        Завантажити це відео-->
<!--    </a>-->
<!--</div>-->
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
