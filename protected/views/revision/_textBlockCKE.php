<div class="element">
    <?php $this->renderPartial('/revision/_editToolbarCKE', array(
        'idEl' =>  $data['id'],
        'editMode' => $editMode,
    ));?>
    <div edit-block class="text" id="<?php echo "t" . $data['id']; ?>" >
        <div ng-non-bindable>
            <?php echo $data['html_block']; ?>
        </div>
    </div>
</div>


