<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.06.2015
 * Time: 17:47
 */
?>
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/roles.css" />
<p class="header">Ролі <?php echo $name;?></p>
<?php
for ($i = count($roles)-1; $i > 0; $i--){
    echo '<div class="atts">'.TeacherHelper::getRoleTitle($roles[$i]['role']).'</div>';
    $atts = RoleAttribute::model()->type($roles[$i]['role'])->findAll();
    for($j=0;$j<count($atts);$j++){
        echo '<div class="params">'.($j+1).". ".$atts[$j]->name." => ".TeacherHelper::getTeacherAttributeValue($teacherId,$atts[$j]->id).'</div>';
    }
}

