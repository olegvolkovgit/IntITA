<?php
/* @var $model Teacher*/
/* @var $module Module */

if (!empty($model->modulesActive)) {
    ?>
    <p>
        <?php echo Yii::t('teachers', '0061'); ?>
    </p>
    <div class="TeacherProfilecourse">

        <div class="teacherCourses">
            <ul>
                <?php
                foreach ($model->modulesActive as $module) {
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
        </div>
    </div>
<?php } ?>