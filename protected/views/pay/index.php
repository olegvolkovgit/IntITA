<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/access.css" />
<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 04.06.2015
 * Time: 16:04
 */
/* @var $this PayController */
$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
    'Сплатити зараз',
);
?>

<div id="addAccessModule">
    <br>
    <a name="form"></a>
    <form action="<?php echo Yii::app()->createUrl('pay/payNow');?>" method="POST" name="add-access">
        <fieldset>
            <legend id="label">Оплатити модуль:</legend>
            Користувач:<br>
            <select name="user" placeholder="(Виберіть користувача)" autofocus>
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
            Курс:<br>
            <select name="course" placeholder="(Виберіть курс)" onchange="javascript:selectModule();">
                <option value="">Всі курси</option>
                <optgroup label="Виберіть курс">
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

            Модуль:<br>
            <div name="selectModule" style="float:left;"></div>
            <br>
            <br>

            <input type="submit" value="Сплатити зараз">
    </form>
    <?php if(Yii::app()->user->hasFlash('error')){?>
        <div style="color: red">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php } ?>
    <?php if(Yii::app()->user->hasFlash('pay')){?>
        <div style="color: green">
            <?php echo Yii::app()->user->getFlash('pay'); ?>
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
                url: "/permissions/showModules",
                data: {course: course},
                cache: false,
                success: function(response){ $('div[name="selectModule"]').html(response); }
            });
        }
    }
</script>