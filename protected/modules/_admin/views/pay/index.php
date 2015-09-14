<link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/access.css" />
<?php
/* @var $this PayController */
?>

<div id="addAccessModule">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('pay/payModule');?>" method="POST" name="add-accessModule">
        <fieldset>
            <legend id="label"><?php echo Yii::t('payments', '0593'); ?>:</legend>
            <?php echo Yii::t('payments', '0595'); ?>:<br>
            <select name="user" placeholder="(<?php echo Yii::t('payments', '0594'); ?>)" autofocus>
                <?php $users = AccessHelper::generateUsersList();
                $count = count($users);
                for($i = 0; $i < $count; $i++){
                    ?>
                    <option value="<?php echo $users[$i]['id'];?>"><?php echo $users[$i]['alias'];?></option>
                <?php
                }
                ?>
            </select>
            <br>
            <br>
            <?php echo Yii::t('payments', '0605'); ?>:<br>
            <select name="course" placeholder="(<?php echo Yii::t('payments', '0603'); ?>)" onchange="javascript:selectModule();">
                <option value=""><?php echo Yii::t('payments', '0596'); ?></option>
                <optgroup label="<?php echo Yii::t('payments', '0597'); ?>">
                    <?php $courses = AccessHelper::generateCoursesList();
                    $count = count($courses);
                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];?></option>
                    <?php
                    }
                    ?>
            </select>
            <br>
            <br>

            <?php echo Yii::t('payments', '0598'); ?>:<br>
            <div name="selectModule" style="float:left;"></div>
            <br>
            <br>

            <input type="submit" value="<?php echo Yii::t('payments', '0599'); ?>">
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
    <form action="<?php echo Yii::app()->createUrl('pay/payCourse');?>" method="POST" name="add-accessCourse">
        <fieldset>
            <legend id="label"><?php echo Yii::t('payments', '0600'); ?>:</legend>
            <?php echo Yii::t('payments', '0600'); ?><?php echo Yii::t('payments', '0595'); ?>:<br>
            <select name="user" placeholder="(<?php echo Yii::t('payments', '0601'); ?>)" autofocus>
                <?php $users = AccessHelper::generateUsersList();
                $count = count($users);
                for($i = 0; $i < $count; $i++){
                    ?>
                    <option value="<?php echo $users[$i]['id'];?>"><?php echo $users[$i]['alias'];?></option>
                <?php
                }
                ?>
            </select>
            <br>
            <br>
            <?php echo Yii::t('payments', '0605'); ?>:<br>
            <select name="course" placeholder="(<?php echo Yii::t('payments', '0603'); ?>)" >
                <option value=""><?php echo Yii::t('payments', '0602'); ?></option>
                <optgroup label="<?php echo Yii::t('payments', '0603'); ?>">
                    <?php $courses = AccessHelper::generateCoursesList();
                    $count = count($courses);
                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'];?></option>
                    <?php
                    }
                    ?>
            </select>
            <br>
            <br>


            <input type="submit" value="<?php echo Yii::t('payments', '0604'); ?>">
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

<script type="text/javascript">
    function selectModule(){
        var course = $('select[name="course"]').val();
        if(!course){
            $('div[name="selectModule"]').html('');
            $('div[name="selectLecture"]').html('');
        }else{
            $.ajax({
                type: "POST",
                url: "/_admin/permissions/showModules",
                data: {course: course},
                cache: false,
                success: function(response){ $('div[name="selectModule"]').html(response); }
            });
        }
    }
</script>