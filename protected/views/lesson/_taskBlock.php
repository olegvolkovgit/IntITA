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
            <?php echo $data['html_block'];?>
            </div>
            <form class="sendAnswer" id="sendAnswer">
                <textarea name="code" id="code" value='std::cout << \"Hello World!\" << std::endl;'> </textarea>
            </form>
            <button class="taskSubmit" onclick='sendAnswer()'><?php echo Yii::t('lecture','0089'); ?></button>
            <div id="content1"></div>
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
        function sendAnswer(){
            document.getElementById('addTask').style.display = 'none';
            var command = {
                "operation": "start",
                "session" : "1241q223f4f2341",
                "jobid" : 11,
                "code" : "std::cout << \"Hello World!\" << std::endl;",
                "task": 2,
                "lang": "c++"
            };
            var jqxhr = $.post( "http://ii.itatests.com", JSON.stringify(command), function(){
                alert( "success" );
            })
                .done(function(data) {
                    alert( data );
                })
                .fail(function() {
                    alert( "error" );
                })
                .always(function() {

                }, "json");
        }

</script>