<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 23.12.2015
 * Time: 17:47
 * @var $teacher Teacher
 */
?>


<div class="col-md-9">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'teachers', $teacher->foto_url); ?>" class="img-thumbnail">
    <ul class="list-group">
        <li class="list-group-item">
        </li>
        <li class="list-group-item">Ім'я :
            <a href="<?php echo Yii::app()->createUrl('profile/index',array('idTeacher' => $teacher->teacher_id)) ?>">
            <?php echo $teacher->getName() ?></a></li>
        <li class="list-group-item">Електрона пошта : <?php echo $teacher->email ?></li>
        <li class="list-group-item"> Які веде модулі :<br>
        <?php $modules = $teacher->getModulesByTeacher($teacher->teacher_id);
                foreach($modules as $module)
                {
                    echo $module['title'];
                    echo "<br>";
                }?>

        </li>
    </ul>



</div>


