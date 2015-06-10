<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 23.05.2015
 * Time: 13:32
 */
?>

<div id="addTeacher">
    <br>
    <a name="formNewTeacher"></a>
    <form action="<?php echo Yii::app()->createUrl('permissions/addTeacher');?>" method="POST" name="add-access">
        <fieldset>
            <legend id="label">Зробити викладачем:</legend>
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
            <input type="submit" value="Зробити викладачем">
    </form>
</div>
<?php //if(Yii::app()->user->hasFlash('warning')):?>
<!--    <div class="info">-->
<!--        --><?php //echo Yii::app()->user->getFlash('warning'); ?>
<!--    </div>-->
<?php //endif; ?>
