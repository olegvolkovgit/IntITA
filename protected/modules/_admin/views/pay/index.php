<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'access.css'); ?>" />
<?php
/* @var $this PayController */
?>
<?php if(!empty($cancelMode)) {
    $moduleAction = 'cancelModule';
    $courseAction = 'cancelCourse';
    $buttonModuleName = 'Скасувати доступ до модуля';
    $buttonCourseName = 'Скасувати доступ до курсу';
    $headerName = 'Скасувати доступ до курсу/модуля';
    $fieldsetModule = $buttonModuleName;
    $fieldsetCourse = $buttonCourseName;
}
    else
    {
        $moduleAction = 'payModule';
        $courseAction = 'payCourse';
        $buttonModuleName = Yii::t('payments', '0599');
        $buttonCourseName = Yii::t('payments', '0604');
        $headerName = 'Автоматична оплата курсу/модуля';
        $fieldsetModule = Yii::t('payments', '0593');
        $fieldsetCourse = Yii::t('payments', '0600');
    }
 ?>
<div class="page-header">
<h2><?php echo $headerName?></h2>
</div>
<div class="col-md-4">
    <div id="addAccessModule">
    <br>
    <div id="findModule" class="form-group">
        <form name = 'findUsers' method="POST" >
            <input type="text" id = 'find' name = "find" class="form-control" placeholder="Введіть e-mail користувача">
            <br>
            <input type="button" class="btn btn-default" onclick = "findUserByEmail()" value="Знайти користувача">
        </form>
    </div>

    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('/_admin/pay/'.$moduleAction);?>" method="POST" name="add-accessModule" onsubmit="return checkModuleField();">
        <fieldset>
            <legend id="label"><?php echo $fieldsetModule ?>:</legend>

            <div class="form-group">
            <?php echo Yii::t('payments', '0595'); ?>:<br>
            <select name="user" id="user" class="form-control"  placeholder="(<?php echo Yii::t('payments', '0594'); ?>)" autofocus>
                <?php $users = StudentReg::generateUsersList();
                $count = count($users);
                for($i = 0; $i < $count; $i++){
                    ?>
                    <option value="<?php echo $users[$i]['id'];?>"><?php echo $users[$i]['alias'];?></option>
                <?php
                }
                ?>
            </select>
            </div>

            <br>
            <br>
            <div class="form-group">
            <?php echo Yii::t('payments', '0605'); ?>:<br>
            <select id="moduleCourseList" name="course"  class="form-control" placeholder="(<?php echo Yii::t('payments', '0603'); ?>)" onchange="selectModule();">
                <option value=""><?php echo Yii::t('payments', '0596'); ?></option>
                <optgroup label="<?php echo Yii::t('payments', '0597'); ?>">
                    <?php $courses = Course::generateCoursesList();
                    $count = count($courses);
                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'].' ('.
                                $courses[$i]['language'].')'?></option>
                    <?php
                    }
                    ?>
            </select>
                </div>
            <br>
            <br>
            <?php echo Yii::t('payments', '0598'); ?>:<br>
            <div name="selectModule" class="form-group" style="float:left;"></div>
            <br>
            <br>
            <br>

            <div class="form-group">
            <input type="submit" class="btn btn-default" value="<?php echo $buttonModuleName ?>">
            </div>
    </form>

    <?php if(Yii::app()->user->hasFlash('errorModule')){?>
        <div style="color: red">
            <?php echo Yii::app()->user->getFlash('errorModule'); ?>
        </div>
    <?php } ?>
    <?php if(Yii::app()->user->hasFlash('payModule')){?>
        <div style="color: green">
            <?php echo Yii::app()->user->getFlash('payModule'); ?>
        </div>
    <?php } ?>
</div>

<div id="addAccessModule">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('/_admin/pay/'.$courseAction);?>" method="POST" name="add-accessCourse" onsubmit="return checkCourseField();">
        <fieldset>
            <legend id="label"><?php echo $fieldsetCourse ?>:</legend>
            <div class="form-group">
            <?php echo Yii::t('payments', '0595'); ?>:<br>
            <select name="user" class="form-control"  placeholder ="(<?php echo Yii::t('payments', '0601'); ?>)" autofocus>
                <?php $users = StudentReg::generateUsersList();
                $count = count($users);
                for($i = 0; $i < $count; $i++){
                    ?>
                    <option value="<?php echo $users[$i]['id'];?>"><?php echo $users[$i]['alias'];?></option>
                <?php
                }
                ?>
            </select>
                </div>
            <br>
            <br>
            <div class="form-group">
            <?php echo Yii::t('payments', '0605'); ?>:<br>
            <select id="courseList" class="form-control"  name="course" placeholder="(<?php echo Yii::t('payments', '0603'); ?>)" >
                <option value=""><?php echo Yii::t('payments', '0602'); ?></option>
                <optgroup label="<?php echo Yii::t('payments', '0603'); ?>">
                    <?php $courses = Course::generateCoursesList();
                    $count = count($courses);
                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];?></option>
                    <?php
                    }
                    ?>
            </select>
                </div>
            <br>
            <br>


            <input type="submit" class="btn btn-default" value="<?php echo $buttonCourseName ?>">
    </form>
    <?php if(Yii::app()->user->hasFlash('errorCourse')){?>
        <div style="color: red">
            <?php echo Yii::app()->user->getFlash('errorCourse'); ?>
        </div>
    <?php } ?>
    <?php if(Yii::app()->user->hasFlash('payCourse')){?>
        <div style="color: green">
            <?php echo Yii::app()->user->getFlash('payCourse'); ?>
        </div>
    <?php } ?>
</div>
</div>
<br>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'findUserInPay.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'pay.js'); ?>"></script>
