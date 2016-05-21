<?php if($editMode){?>
    <div class="editToolbar" id="<?php echo 'p'.$idEl; ?>" >
        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'up.png'); ?>" class="editIco"
             up-block >
        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png'); ?>" class="editIco"
             down-block >
        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png'); ?>" class="editIco"
             delete-block >
    </div>
<?php }?>