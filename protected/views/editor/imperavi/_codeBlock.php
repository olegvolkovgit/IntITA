<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:37
 */
?>
<div class="element">
    <?php $this->renderPartial('/editor/imperavi/_editToolbar', array(
        'idLecture' => $data['id_lecture'],
        'order' =>  $data['block_order'],
        'editMode' => $editMode,
    ));?>

    <div class="code" id="<?php echo "t" . $data['block_order'];?>" onclick="function(){order = this.id;}">
    <?php echo $data['html_block'];?>
    </div>
</div>
