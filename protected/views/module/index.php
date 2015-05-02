<!-- Module style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module.css" />
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
<!-- Module style -->
<!-- BD -))) -->
<?php
$this->pageTitle = 'INTITA';
//$post = Module::model()->findByPk(1);
?>
<!-- BD -))) -->
<?php

$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",Course::model()->findByPk($post->course)->course_name =>Yii::app()->request->baseUrl."/course",$post->module_name,
);
?>

<div class="ModuleBlock">
    <div class="leftModule">
        <div class="headerLeftModule">
            <table>
                <tr>
                    <td>
                        <img class="moduleImg" src="<?php echo Yii::app()->request->baseUrl.$post->module_img ?>" />
                    </td>
                    <td style="padding-left: 15px;">

                        <span id="titleModule"><?php echo Yii::t('module', '0211'); ?></span>
                        <?php echo $post->module_name;?>

                        <div>
                            <span id="titleModule"><?php echo Yii::t('module', '0212'); ?></span>
                            <?php echo "<b>", $post->lesson_count, "</b>"; ?>
                            <img class="time" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/timeIco.png"/>
                            <span id="titleModule"><?php echo Yii::t('module', '0213'); ?></span>
                            <?php echo "<b>", $post->module_duration_hours, "</b> год"; ?>
                            <img class="time" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/timeIco.png"/>
                        </div>

                        <div>
                            <span id="titleModule"><?php echo Yii::t('module', '0214'); ?></span>
                            <?php echo "сильний початківець"?>

                            <?php
                            for ($i=0; $i<3; $i++)
                            {
                                ?><span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco1.png"/>
                                </span><?php
                            }
                            for ($i=0; $i<2; $i++)
                            {
                                ?><span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco0.png"/>
                                </span><?php
                            }
                            ?>
                        </div>
                        <div>
                            <span id="titleModule"><?php echo Yii::t('module', '0215'); ?></span>
                            <b>25 <?php echo Yii::t('module', '0216'); ?></b>, <?php echo Yii::t('module', '0217'); ?> - <b>2 <?php echo Yii::t('module', '0218'); ?></b> (3 <?php echo Yii::t('module', '0219'); ?>, 3 <?php echo Yii::t('module', '0220'); ?>)
                        </div>
                        <div>
                            <span id="titleModule"><?php echo Yii::t('module', '0221'); ?></span>
                            3000.00 <?php echo Yii::t('module', '0222'); ?> 1500.00 <?php echo Yii::t('module', '0222'); ?> (<?php echo Yii::t('module', '0223'); ?>)
                        </div>
                        <div>
                            <div >
                                <span id="titleModule"><?php echo Yii::t('module', '0224'); ?></span>
                                <?php
                                for ($i = 0; $i < 9; $i++) {
                                    ?><span>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png">
                                    </span><?php
                                }
                                for ($i = 0; $i < 1; $i++) {
                                    ?><span>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png">
                                    </span><?php
                                }
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="lessonModule" id="lectures">
                <a name="list">
                    <?php
                    if ($editMode){
                    ?>
                        <div onclick="showForm();">
                            <a href="#lessonForm">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/add_lesson.png"
                                     id="addLessonButton" title="Додати заняття"/>
                            </a>
                        </div>
                    <?php
                    }?>
                <h2><?php echo Yii::t('module', '0225'); ?></h2>

                <?php
                for ($i = 0; $i < $post->lesson_count; $i++) {
                    ?>
                    <div id="<?php echo ($i+1);?>">
                        <table>
                            <tr>
                                <td <?php if ($editMode){echo 'style="width:155px;"';} ?>>
                                    <?php
                                    if ($editMode){
                                    ?>
                                    <span class="editToolbar" id="<?php echo ($i+1);?>.'toolbar'">
                                        <a href="#list" onclick="unableLecture(<?php echo ($i+1);?>, <?php echo $post->module_ID;?>);">
                                            <img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/delete.png" id="unable<?php echo ($i+1);?>"/>
                                        </a>
                                         <a href="#list" onclick="downLecture(<?php echo ($i+1);?>);">
                                            <img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/down.png" id="down<?php echo ($i+1);?>"/>
                                        </a>
                                         <a href="#list" onclick="upLecture(<?php echo ($i+1);?>);">
                                            <img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/up.png" id="up<?php echo ($i+1);?>"/>
                                        </a>
                                    </span>
                                    <?php
                                    }?>
                                    <?php echo "  ".Yii::t('module', '0226')," ",$i+1,"."; ?>
                                </td>
                                <td>
                                    <span> <a href="<?php echo Yii::app()->request->baseUrl; ?>/lesson"><?php echo $lecturesTitles[$i] ;?></a> </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php
                }
                ?>
                    <?php
                    if ($editMode){
                    ?>
                <div id="lessonForm">
                <form id="addLessonForm" action="<?php echo Yii::app()->createUrl('module/saveLesson');?>" method="post">
                    <br>
                    <span id="formLabel">Нове заняття:</span>
                    <br>
                    <span><?php echo Yii::t('module', '0226')." ".($post->lesson_count + 1)."."; ?></span>
                    <input name="idModule" value="<?php echo $post->module_ID;?>" hidden="hidden">
                    <input name="order" value="<?php echo ($post->lesson_count + 1);?>" hidden="hidden">
                    <input name="lang" value="<?php echo $post->language;?>" hidden="hidden">
                    <input type="text" name="newLectureName" id="newLectureName" required pattern="^[=а-яА-ЯёЁa-zA-Z0-9 ()/+-]+$">
                    <br><br>
                    <input type="submit"  value="ADD LESSON" id="submitButton">
<!--                    onclick="sendForm();"-->
                </form>
                </div>
                    <?php
                    }?>
            </div>
        </div>
    </div>

    <div class="rightModule">
        <?php
        for ($i = 0; $i < count($teachers); $i++) {
            ?>
            <div class="teacherBox">
                <table>
                    <tr>
                        <td class="teacherBoxLeft">
                            <img  src="<?php echo Yii::app()->request->baseUrl.$teachers[$i]->foto_url; ?>"/>
                            <a href="<?php echo Yii::app()->request->baseUrl.$teachers[$i]->readMoreLink; ?>"><?php echo Yii::t('module', '0228'); ?> &#187;</a>
                        </td>
                        <td  class="teacherBoxRight" ">
                        <h2><?php echo Yii::t('module', '0227'); ?></h2>
                        <div style="line-height: 1.2;">
                            <?php echo $teachers[$i]->last_name." ".$teachers[$i]->first_name;?>
                            <br>
                            <?php echo $teachers[$i]->email;?>

                            <?php echo $teachers[$i]->tel;?>

                            <?php echo $teachers[$i]->skype;?>
                        </div>
                        </td>
                    </tr>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<script type="text/javascript">
    function showForm(){
        $form = document.getElementById('lessonForm');
        $form.style.display = 'block';
    }

    function sendForm(){
        $form = document.getElementById('lessonForm');
        $form.style.display = 'none';
    }



    function unableLecture(idLecture, idModule) {
        var xmlhttp;
        var id = 'unable' + idLecture;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("lectures").innerHTML=xmlhttp.responseText;
            }
        }

        xmlhttp.open("post",<?php echo Yii::app()->createUrl('module/unableLesson');?>,true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xmlhttp.send("order="+idLecture+"&idModule="+idModule);
    }

    function downLecture(idLecture) {
        alert("id = "+idLecture +" down");
        var id = 'down' + idLecture;

    }

    function upLecture(idLecture) {
        alert("id = "+idLecture + " up");
        var id = 'up' + idLecture;

    }
</script>