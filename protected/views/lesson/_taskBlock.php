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
            <form method="post" class="sendAnswer" id="sendAnswer" action="#">
                <textarea name="code" id="code" value='std::cout << \"Hello World!\" << std::endl;'> </textarea>
                <input id="taskSubmit" type="submit" value="<?php echo Yii::t('lecture','0089'); ?>" onclick="test()">
            </form>
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
//    $(function() {
//        $("#sendAnswer").submit(function() {
//            $.ajax({
//                url: 'http://ii.itatests.com',
//                type: 'POST',
//                dataType:"json",
//                data: {
//                    "operation" : "status",
//                    "session" : "123456789044241232",
//                    "jobid" : 1
//                }
//            });
//        });
//    });
    function test() {
        cart = {
            "operation" : "status",
            "session" : "123456789044241232",
            "jobid" : 1
        };
        alert ( JSON.stringify( cart ) );

        $.ajax({
            type: "POST",
            url: "http://ii.itatests.com",
            dataType: "json",
            data: cart,
            beforesend: $('.content1').html('Загрузка'),

            success: function(data, code){
                if (code==200){
                    $('#code').html(data); // запрос успешно прошел
                    //alert(data);
                }else{
                    $('#code').html(code); // возникла ошибка, возвращаем код ошибки
                    //alert(code);
                }
                $('.code').html('Your code: '+data.code); // данные которые вернул сервер!
            },

            error:  function(xhr, str){
                $('.code').html('Критическая ошибка');
            },

            complete:  function(){ //а тут ничего из предложенных параметров не берем :)
                $('#something').hide(); //например, спрятали какую-то кнопочку, которая вызывала запрос
            }

        });

    }
</script>