<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:45
 */
?>
<div class="element">
    <?php $this->renderPartial('_editToolbar', array('idLecture' => $data['id_lecture'], 'order' =>  $data['block_order'], 'editMode' => $editMode,));?>
    <div style="position:relative;"><a name="<?php echo $data['html_block'];?>" style="position:absolute; top:-60px;"></a></div>
    <h1 class="lessonPart">
    <?php echo $data['html_block'];?>
    </h1>
</div>