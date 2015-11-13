<link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/access.css" />
<?php
/* @var $this PayController */
?>
<h2>Автоматична оплата курса/модуля</h2>
<div id="addAccessModule">
    <br>
    <div id="findModule">
        <form name = 'findUsers' method="POST" >
            <input type="text" id = 'find' name = "find" placeholder="Введіть e-mail користувача">
            <input type="button" onclick = "findUserByEmail()" value="Знайти користувача">

        </form>

    </div>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('/_admin/pay/payModule');?>" method="POST" name="add-accessModule">
        <fieldset>
            <legend id="label"><?php echo Yii::t('payments', '0593'); ?>:</legend>
            <?php echo Yii::t('payments', '0595'); ?>:<br>
            <select name="user" id="user"  placeholder="(<?php echo Yii::t('payments', '0594'); ?>)" autofocus>
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
            <select name="course" placeholder="(<?php echo Yii::t('payments', '0603'); ?>)" onchange="selectModule();">
                <option value=""><?php echo Yii::t('payments', '0596'); ?></option>
                <optgroup label="<?php echo Yii::t('payments', '0597'); ?>">
                    <?php $courses = AccessHelper::generateCoursesList();
                    $count = count($courses);
                    for($i = 0; $i < $count; $i++){
                        ?>
                        <option value="<?php echo $courses[$i]['id'];?>"><?php echo $courses[$i]['alias'].' ('.
                                $courses[$i]['language'].')'?></option>
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
    <form action="<?php echo Yii::app()->createUrl('/_admin/pay/payCourse');?>" method="POST" name="add-accessCourse">
        <fieldset>
            <legend id="label"><?php echo Yii::t('payments', '0600'); ?>:</legend>
            <?php echo Yii::t('payments', '0595'); ?>:<br>
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
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'findUserInPay.js'); ?>"></script>
<script type="text/javascript">
    function selectModule(){
        var course = $('select[name="course"]').val();
        if(!course){
            $('div[name="selectModule"]').html('');
            $('div[name="selectLecture"]').html('');
        }else{
            $.ajax({
                type: "POST",
                url:  "/IntIta/_admin/permissions/showModules",
                data: {course: course},
                cache: false,
                success: function(response){ $('div[name="selectModule"]').html(response); }
            });
        }
    }

    function findUserByEmail() {
        var find = $('#find');
        var email = find.val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(find.val())) {
            alert('Please provide a valid email address');
            return false;
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "/_admin/permissions/showUsers",
                data : {email : email},
                success: function(JSON){

                    if(JSON == false) alert('Kористувач с таким email не знайдено');
                    else{
                    var select = document.getElementsByName('user');

                    for(var i = 0; i < select.length; i++)
                    {
                        var nodeList = select[i];

                        for(var k = 0; k < nodeList.length; k++)
                        {
                            if (nodeList.options[k].value == JSON)
                            {
                                select[i].selectedIndex = k;
                            }
                        }
                    }
                    }
                }
            });
        }
    }
</script>