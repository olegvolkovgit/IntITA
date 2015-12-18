<?php
/**
@var $roles TeacherRoles
 */
?>
    <link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'roles.css'); ?>" />
    <br>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/addTeacherRole', array(
        'teacher' => $teacherId));?>">Призначити роль</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/cancelTeacherRole/', array('id' => $teacherId));?>">
        Скасувати роль</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/addTeacherRoleAttribute/?teacher='.$teacherId);?>">Призначити атрибут ролі</a>
    </button>
    <br>
    <div class="page-header">
    <p class="header">Ролі викладача <?php echo $name;?></p>
    </div>
<?php
for ($i = count($roles)-1; $i >= 0; $i--){
    echo '<div class="atts">'.Roles::getRoleTitle($roles[$i]['role']).'</div>';
    $atts = RoleAttribute::model()->type($roles[$i]['role'])->findAll();
    if (!empty($atts)) {
        for ($j = 0; $j < count($atts); $j++) {
            echo '<div class="params">' . ($j + 1) . ". " . $atts[$j]->name_ua . ' = ' .
                RoleAttribute::getTeacherAttributeValue($teacherId, $atts[$j]->id) . '</div>';
        }
    }
}
?>