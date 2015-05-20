<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:37
 */
?>
<div class="element">
    <?php $this->renderPartial('_editToolbar', array('idLecture' => $data['id_lecture'], 'order' =>  $data['block_order']));?>

    <div class="code" id="<?php echo "t" . $data['block_order'];?>">
    <?php echo $data['html_block'];?>
    </div>
</div>