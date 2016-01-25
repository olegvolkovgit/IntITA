<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 21.10.2015
 * Time: 14:25
 */
if(!empty($modules)){
    ?>
        <select name="mandatory" id="moduleList" class = "form-control" >
            <option value="">Виберіть модуль</option>
            <optgroup label="Модулі">
        <?php foreach($modules as $module) { ?>
              <option value="<?php echo $module['module_ID'];?>"><?php echo $module['title_ua'];?></option>
            <?php  }  ?>
        </select><?php
}
?>

