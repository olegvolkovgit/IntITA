<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 01.05.2015
 * Time: 17:35
 */

?>
<div  id="lectures">
                <a name="list">
                        <div onclick="showForm();">
                            <a href="#lessonForm">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/add_lesson.png"
                                     id="addLessonButton" title="Додати заняття"/>
                            </a>
                        </div>
<h2><?php echo Yii::t('module', '0225'); ?></h2>

<?php
for ($i = 0; $i < $post->lesson_count; $i++) {
    ?>
    <div id="<?php echo ($i+1);?>">
        <table>
            <tr>
                <td <?php echo 'style="width:155px;"'; ?>>
                        <span class="editToolbar" id="<?php echo ($i+1);?>.'toolbar'">
                                        <a href="#list" onclick="unableLecture(<?php echo ($i+1);?>);">
                                            <img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/delete.png" id="unable<?php echo ($i+1);?>"/>
                                        </a>
                                         <a href="#list" onclick="downLecture(<?php echo ($i+1);?>);">
                                             <img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/down.png" id="down<?php echo ($i+1);?>"/>
                                         </a>
                                         <a href="#list" onclick="upLecture(<?php echo ($i+1);?>);">
                                             <img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/up.png" id="up<?php echo ($i+1);?>"/>
                                         </a>
                                    </span>
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
?><div id="lessonForm">
        <form id="addLessonForm" action="/IntITA/module/saveLesson" method="post">
            <br>
            <span id="formLabel">Нове заняття:</span>
            <br>
            <span><?php echo Yii::t('module', '0226')." ".($post->lesson_count + 1)."."; ?></span>
            <input name="idModule" value="<?php echo $post->module_ID;?>" hidden="hidden">
            <input name="order" value="<?php echo ($post->lesson_count + 1);?>" hidden="hidden">
            <input name="lang" value="<?php echo $post->language;?>" hidden="hidden">
            <input type="text" name="newLectureName" id="newLectureName" required pattern="^[а-яА-ЯёЁa-zA-Z0-9 ()/+-]+$">
            <br><br>
            <input type="submit"  value="ADD LESSON" id="submitButton">
        </form>
    </div>
</div>
</div>