<?php
/**
 * @var $teacher Teacher
 * @var $module Module
 */
?>
<div class="col-md-9">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'teachers', $teacher->foto_url); ?>"
         class="img-thumbnail" style="height:200px">
    <ul class="list-group">
        <li class="list-group-item">
        </li>
        <li class="list-group-item">Ім'я :
            <a href="<?php echo Yii::app()->createUrl('profile/index', array('idTeacher' => $teacher->teacher_id)) ?>">
                <?php echo $teacher->getName() ?></a></li>
        <li class="list-group-item">Електронна пошта : <?php echo $teacher->email ?></li>
        <li class="list-group-item"> Які веде модулі :<br>
            <?php if (!empty($teacher->modules)) {?>
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
            <?php } ?>
        </li>
    </ul>
</div>



