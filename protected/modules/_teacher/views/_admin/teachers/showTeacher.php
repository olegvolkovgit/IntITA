<?php
/**
 * @var $teacher Teacher
 * @var $module Module
 * @var $role Roles
 */
?>
<div class="col-md-9">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/index'); ?>','Викладачі')">
                Викладачі
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/addTeacherRole', array(
                        'teacher' => $teacher->teacher_id)); ?>','Призначити роль')">Призначити роль
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/cancelTeacherRole/',
                        array('id' => $teacher->teacher_id)); ?>','Скасувати роль')">Скасувати роль
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/addTeacherRoleAttribute/',
                        array('teacher' => $teacher->teacher_id)); ?>','Призначити атрибут ролі')">Призначити атрибут
                ролі
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/roles'); ?>')">
                Ролі викладачів
            </button>
        </li>
    </ul>

    <img src="<?php echo StaticFilesHelper::createPath('image', 'teachers', $teacher->foto_url); ?>"
         class="img-thumbnail" style="height:200px">
    <ul class="list-group">
        <li class="list-group-item">
        </li>
        <li class="list-group-item">Ім'я:
            <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher->teacher_id)) ?>">
                <?php echo $teacher->getName() ?></a></li>
        <li class="list-group-item">Електронна пошта: <?php echo $teacher->email ?></li>
        <li class="list-group-item">Статус: <em><?php echo $teacher->getStatus() ?></em></li>

        <?php if (!empty($teacher->roles)) { ?>
        <li class="list-group-item">Ролі викладача:
            <ul>
                <?php foreach ($teacher->roles() as $role) { ?>
                    <li><?= $role->title_ua; ?></li>
                <?php } ?>
            </ul>
        </li>
        <?php } ?>

        <?php if (!empty($teacher->modules)) { ?>
        <li class="list-group-item"> Веде модулі:<br>
            <ul>
                <?php
                foreach ($teacher->modules as $module) {
                    ?>
                    <li>
                        <a href="<?php echo Yii::app()->createUrl('module/index',
                            array('idModule' => $module->module_ID)); ?>">
                            <?php echo $module->getTitle() . ', ' . $module->language; ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </li>
        <?php } ?>
    </ul>
</div>



