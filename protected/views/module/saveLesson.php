<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 30.04.2015
 * Time: 17:12
 */
if (Lecture::model()->addNewLesson($_POST['idModule'], $_POST['newLectureName'], $_POST['order']))
{
        ?>
        <br>
        <br>
        Нова лекція <?php echo "№".$_POST['order']." ".$_POST['newLectureName'];?>
        додана до модуля <?php echo $_POST['idModule'];?>.
        <br><a href="<?php echo Yii::app()->createUrl('module'); ?>">
        Повернутися на сторінку модуля.
        </a>
<?php
}
?>
