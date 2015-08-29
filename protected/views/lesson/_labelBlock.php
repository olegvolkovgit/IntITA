<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:45
 */
?>
<div class="element">
    <?php $this->renderPartial('_editToolbar', array(
        'idLecture' => $data['id_lecture'],
        'order' =>  $data['block_order'],
        'idBlock' => $data['id_block'],
        'editMode' => $editMode,));
    ?>

    <a name="<?php echo strip_tags($data['html_block']);?>" ></a>
    <h1 class="lessonPart" >
        <div class="labelBlock" id="<?php echo "t" . $data['block_order'];?>" onclick="function(){order = this.id;}"><?php echo $data['html_block'];?></div>
    </h1>

</div>
