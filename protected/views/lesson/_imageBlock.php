    <div class="element">
        <?php $this->renderPartial('/editor/_editToolbar', array(
            'idLecture' => $data['id_lecture'],
            'order' =>  $data['block_order'],
            'editMode' => $editMode,
        ));?>

        <div class="image" id="<?php echo "t" . $data['block_order'];?>" >
            <img src="<?php echo $data['html_block'];?>"  >
        </div>
    </div>
