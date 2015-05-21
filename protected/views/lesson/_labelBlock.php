<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:45
 */
?>
<div class="element">
    <?php $this->renderPartial('_editToolbar', array('idLecture' => $data['id_lecture'], 'order' =>  $data['block_order']));?>

    <?php echo $data['html_block'];?>
</div>