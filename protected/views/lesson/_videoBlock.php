<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:40
 */
?>
<div class="element">
    <?php $this->renderPartial('_editToolbar', array(
        'idLecture' => $data['id_lecture'],
        'order' =>  $data['block_order'],
        'editMode' => $editMode,
    ));?>

<div class="video" id="<?php echo "t" . $data['block_order'];?>">
<h3><span class="subChapter">Відео 1.</span></h3>
<iframe width="778" height="480" src="<?php echo $data['html_block'];?>" frameborder="0" allowfullscreen></iframe>

<!--<div class="download" id="do2">-->
<!--    <a  href="#">-->
<!--        <img style="" src="--><?php //echo StaticFilesHelper::createPath('image', 'lecture', '000zav-se-vid.png'); ?><!--">-->
<!--        Завантажити це відео-->
<!--    </a>-->
<!--</div>-->
</div>
</div>
