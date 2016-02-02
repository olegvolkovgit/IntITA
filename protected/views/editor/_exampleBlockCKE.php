<div class="element">
    <?php $this->renderPartial('/editor/_editToolbarCKE', array(
        'idLecture' => $data['id_lecture'],
        'order' =>  $data['block_order'],
        'editMode' => $editMode,
    ));?>

<div edit-block class="codeExample" id="<?php echo "t" .  $data['block_order'];?>" >
    <?php echo $data['html_block'];?>
</div>
</div>
