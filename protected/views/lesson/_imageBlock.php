<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 22.06.2015
 * Time: 17:47
 */
?>
    <div class="element">
        <?php $this->renderPartial('_editToolbar', array(
            'idLecture' => $data['id_lecture'],
            'order' =>  $data['block_order'],
            'editMode' => $editMode,
        ));?>

        <div class="video" id="<?php echo "t" . $data['block_order'];?>" onclick="function(){order = this.id;}">
            <img src="<?php echo Yii::app()->request->baseUrl.$data['html_block'];?>"  >
<!--            <img src="--><?php //echo Yii::app()->params['imagesPath'].$data['html_block'];?><!--"  >-->
        </div>
    </div>
