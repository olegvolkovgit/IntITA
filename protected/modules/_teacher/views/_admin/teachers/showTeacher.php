<?php
/**
 * @var $module Module
 * @var $user RegisteredUser
 * @var $role UserRoles
 * @var $teacher Teacher
 */
?>
<div class="col-md-12">
    <div class="row">

        <ul class="list-inline">
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>','Співробітники')">
                    Співробітники
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/addTeacherRole', array(
                            'id' => $teacher->user_id)); ?>','Призначити роль')">Призначити роль
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-primary"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/update', array('id' => $teacher->user_id)); ?>',
                            'Редагувати')">
                    Редагувати
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-success"
                        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/addModule', array('id' => $teacher->user_id)); ?>',
                            'Додати модуль')">
                    Додати модуль
                </button>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $teacher->user->avatar); ?>"
                 class="img-thumbnail" style="height:200px">
        </div>
        <div class="col-md-9">
            <ul class="list-group">
                <li class="list-group-item">Ім'я:
                    <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher->teacher_id)) ?>">
                        <?php echo $teacher->getName() ?></a></li>
                <li class="list-group-item">Електронна пошта: <?php echo $teacher->user->email; ?></li>
                <li class="list-group-item">Статус: <em><?php echo $teacher->getStatus(); ?></em></li>

                <?php if (!empty($user->getRoles())) { ?>
                    <li class="list-group-item">Ролі користувача:
                        <ul>
                            <?php foreach ($user->teacherRoles() as $role) { ?>
                                <li><?= $role; ?>
                                    <a href="#"
                                       onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/editRole/',
                                           array('id' => $teacher->user_id, 'role' => $role)); ?>','<?=addslashes($teacher->user->userName()).", роль ".$role; ?>')"><em>редагувати</em>
                                    </a>
                                    <a href="#"
                                       onclick="cancelTeacherRole('<?= Yii::app()->createUrl("/_teacher/_admin/teachers/unsetTeacherRole"); ?>',
                                           '<?= $role ?>',
                                           '<?= $teacher->user_id; ?>');"><em>скасувати</em>
                                    </a>
                                </li>
                            <?php }
                            if ($user->isAuthor()) { ?>
                                <li>
                                    author: <a href="#"
                                               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/editRole/',
                                                   array('id' => $teacher->user_id, 'role' => 'author')); ?>','<?=addslashes($teacher->user->userName()).", роль author"; ?>')"><em>редагувати</em>
                                    </a>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (!empty($teacher->modulesActive)) { ?>
                    <li class="list-group-item"> Веде модулі:<br>
                        <ul>
                            <?php
                            foreach ($teacher->modulesActive as $module) {
                                if(!$module->cancelled) {
                                    ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('module/index',
                                            array('idModule' => $module->module_ID)); ?>">
                                            <?php echo $module->getTitle() . ', ' . $module->language; ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>



