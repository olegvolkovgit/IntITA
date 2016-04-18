<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:37
 */
?>

<div class="element">
    <?php $this->renderPartial('/revision/_editToolbarCKE', array(
        'idEl' =>  $data['id'],
        'editMode' => $editMode,
    ));?>

    <div edit-code id="<?php echo "t" . $data['id'];?>" >
        <div hljs no-escape><?php echo $data['html_block'];?></div>
    </div>
</div>
