<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.06.2015
 * Time: 17:47
 */
?>
    <div class="element">
        <?php $this->renderPartial('_editToolbar', array(
            'idLecture' => $data['id_lecture'],
            'order' =>  $data['block_order'],
            'editMode' => $editMode,
        ));?>

        <div class="video" id="<?php echo "t" . $data['block_order'];?>" onclick="function(){order = this.id;}">
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl.$data['html_block'];?><!--"  >-->
            <img src="<?php echo Yii::app()->params['imagesPath'].$data['html_block'];?>"  >
        </div>
    </div>

<?php
// use editor WYSIWYG Imperavi
if ($editMode) {
    $this->widget('ImperaviRedactorWidget', array(
        'selector' => "#",
        'options' => array(
            'imageUpload' => Yii::app()->createUrl('/lesson/uploadImage'),
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