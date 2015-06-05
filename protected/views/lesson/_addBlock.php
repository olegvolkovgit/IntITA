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
            <br>
            <span class="formLabel">Новий блок:</span>
            <br>
            <br>
            <input name="idLecture" value="<?php echo $lecture->id;?>" hidden="hidden">
            <input name="order" value="<?php echo ($countBlocks + 1);?>" hidden="hidden">
                <textarea name="newTextBlock" id="newTextBlock" cols="108"
                          placeholder="Введіть контент нового блока" required form="addBlockForm" rows="10">
                </textarea>
            <br>
            <span class="formLabel">Тип блоку:</span>
            <select name="type">
                <option value="1" selected>Текст
                <option value="2" >Відео
                <option value="3" >Код
                <option value="4" >Приклад
                <option value="5" >Завдання
                <option value="6" >Підсумкове завдання
                <option value="7" >Інструкція
                <option value="8" >Заголовок (для змісту)
            </select>
            <br>
            <br>
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
    function saveNewBlock(){
        source = $('#newTextBlock').code.get;
        document.getElementById('newTextBlock').innerHTML = source;
    }
</script>