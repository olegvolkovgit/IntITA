<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 19.05.2015
 * Time: 16:58
 */
?>
<?php if($editMode){?>
    <a name="newBlockForm">
    <div id="textBlockForm">
        <form id="addBlockForm" action="<?php echo Yii::app()->createUrl('lesson/createNewBlock');?>" method="post">
            <br>
            <span id="formLabel">Новий текстовий блок:</span>
            <br>
            <br>
            <input name="idLecture" value="<?php echo $lecture->id;?>" hidden="hidden">
            <input name="order" value="<?php echo ($countBlocks + 1);?>" hidden="hidden">
                <textarea name="newTextBlock" id="newTextBlock" cols="108"
                          placeholder="Введіть текст нового блока" required form="addBlockForm" rows="10">
                </textarea>
            <input type="submit" value="Додати" onclick="saveNewBlock();">
        </form>
    </div>
    <br>
    <br>
<?php }?>
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
<script type="text/javascript">
//    $(function()
//    {
//        $('#newTextBlock').redactor();
//    });

    function saveNewBlock(){
        source = $('#newTextBlock').code.get;
        document.getElementById('newTextBlock').innerHTML = source;
    }
</script>