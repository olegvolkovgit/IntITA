<?php
$teachers = Teacher::model()->findAll();
$modules = Module::model()->findAll();
?>
<!-- course style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/course.css" />
<!-- course style -->
<?php 
for($i = 0; $i < count($teachers); $i++){ 
?>
<div class="courseTeacher">
	<div class="courseTeacherImg">
	    <a href="<?php echo Yii::app()->createUrl('profile');?>">
	        <img src="<?php echo Yii::app()->request->baseUrl . $teachers[$i]->foto_url; ?>" />
	    </a>
	</div>
	<div class="courseTeacherInfo">
	    <h3><a href="<?php echo Yii::app()->createUrl('profile');?>"><?php echo $teachers[$i]->last_name . " " . $teachers[$i]->first_name; ?></a></h3>
	    <table class="courseTeacherDetail">
	    	<?php
	    		for($k = 0; $k < count($modules); $k++){
	    	?>
	        <tr>
	            <td>
	                <span class="colorP"><?php echo Yii::t('course', '0208');  echo $k+1;?> :</span><span class="colorGrey"><a href="<?php echo Yii::app()->createUrl('module');?>"><?php echo $modules[$k]->module_name; ?></a></span>
	            </td>
	        </tr>
	        <?php
	        }
	        ?>
	    </table>
	</div>
</div>
<?php 
}
?>