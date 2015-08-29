<?php
/**
@var $roles TeacherRoles

 */
?>
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/roles.css" />
<a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
<br>
<br>
<a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі</a>

    <p class="header">Ролі викладача <?php echo $name;?></p>
<?php
for ($i = count($roles)-1; $i >= 0; $i--){
    echo '<div class="atts">'.TeacherHelper::getRoleTitle($roles[$i]['role']).'</div>';
    $atts = RoleAttribute::model()->type($roles[$i]['role'])->findAll();
    if (!empty($atts)) {
        for ($j = 0; $j < count($atts); $j++) {
            echo '<div class="params">' . ($j + 1) . ". " . $atts[$j]->name_ua . ' = ' . TeacherHelper::getTeacherAttributeValue($teacherId, $atts[$j]->id) . '</div>';
        }
    }
}

$this->menu=array(
    array('label'=>'Призначити роль', 'url'=>array('/tmanage/addTeacherRole/teacher/'.$teacherId)),
    array('label'=>'Призначити атрибут ролі', 'url'=>array('/tmanage/addTeacherRoleAttribute/teacher/'.$teacherId)),
    array('label'=>'Ролі викладачів', 'url'=>array('roles')),
);
?>

