<!-- regform -->
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'modalTask.css'); ?>"/>
<!-- regform end-->
<div class="mooda">
    <?php
    $qForm = new StudentReg;
    if (is_string($_GET['page']))
        $page = $_GET['page'];
//    else $page = $lastAccessPage;

    $form = $this->beginWidget('CActiveForm', array(
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true, 'validateOnChange' => false),
//        'action' => Yii::app()->createUrl("/lesson/nextPage",
//            array('id' => $_GET['id'], 'idCourse' => $idCourse, 'page' => $page)),
    ));
    ?>
    <div class="signIn2">
        <div id="heedd">
            <table>
                <tr>
                    <td>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'LessFinish.jpg'); ?>">
                    </td>
                    <td>
                        <h1 style=""><?php echo Yii::t('lecture', '0675'); ?></h1>
                    </td>
                </tr>
            </table>

            <div class="happily">
                <p><?php echo Yii::t('lecture', '0679'); ?></p>
            </div>

            <input id="signInButtonM2" type="submit" value="<?php echo Yii::t('lecture', '0681'); ?>">
        </div>
    </div>
    <!-- form -->
    <?php $this->endWidget(); ?>
</div>