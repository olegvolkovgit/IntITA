<div class="element">
    <?php $this->renderPartial('/editor/imperavi/_editToolbar', array(
        'idLecture' => $data['id_lecture'],
        'order' =>  $data['block_order'],
        'editMode' => $editMode,
    ));?>

    <div edit-block class="text" id="<?php echo "t" . $data['block_order']; ?>" onclick="function(){order = this.id;}">
        <?php echo $data['html_block']; ?>
        <?php $idValue = "#" . $data['block_order']; ?>
    </div>
</div>


