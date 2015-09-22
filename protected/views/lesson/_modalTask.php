<!-- regform -->
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'modalTask.css'); ?>"/>
<!-- regform end-->
<div class="mooda">
<?php
$qForm = new StudentReg;
if(isset($_GET['page']))
    $page = $_GET['page'];
else $page = $lastAccessPage;

$form = $this->beginWidget('CActiveForm', array(
    'enableClientValidation' => true,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>false),
    'action' => Yii::app()->createUrl("/lesson/nextPage",array('id'=>$_GET['id'],'idCourse'=>$_GET['idCourse'], 'page'=>$page)),
));
?>
<div  class="signIn2">
<div   id="heedd" ">
    <table>
        <tr>
            <td>
                <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'LessFinish.jpg'); ?>"></td>
            <td>
                <h1 style="">Вітаємо!</h1>
            </td>
        </tr>
    </table>

    <div class="happily">
        <p>Ти успішно вирішив(ла) завдання!<br>
        Тепер ти можеш перейти до наступного матеріалу!</p>
    </div>

<input id="signInButtonM2" type="submit" value="ЗАКРИТИ">
</div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
</div>