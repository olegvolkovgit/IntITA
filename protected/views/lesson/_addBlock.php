<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 19.05.2015
 * Time: 16:58
 */
?>

<a name="newBlockForm">
    <div id="blockForm">
        <div id="textBlockForm">
            <form id="addBlockForm" action="<?php echo Yii::app()->createUrl('lesson/createNewBlock'); ?>"
                  method="post">
                <input name="idLecture" value="<?php echo $lecture->id; ?>" hidden="hidden">
                <input name="type" value="" id="blockType" hidden="hidden">
                <input name="page" value="<?php echo $pageOrder;?>" id="page" hidden="hidden">
                <textarea name="newTextBlock" id="newTextBlock" cols="108" class="wm ontop"
                          placeholder="Введіть контент нового блока" required form="addBlockForm" rows="10">
                </textarea>
                <br>
                <input type="submit" value="Додати" id="addBlockSubmit" onclick="saveNewBlock();">
            </form>
            <button id="cancelButton"
                    onclick="hideForm('blockForm', 'newTextBlock')"><?php echo Yii::t('course', '0368') ?></button>
        </div>
    </div>

    <?php
    if ($editMode) {
        $this->widget('ImperaviRedactorWidget', array(
            'selector' => "#newTextBlock",
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



