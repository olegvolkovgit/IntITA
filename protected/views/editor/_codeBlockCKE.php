<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:37
 */
?>

<div class="element">
    <?php $this->renderPartial('/editor/_editToolbarCKE', array(
        'idLecture' => $data['id_lecture'],
        'order' =>  $data['block_order'],
        'editMode' => $editMode,
    ));?>

    <div edit-code id="<?php echo "t" . $data['block_order'];?>" >
<!--        <div hljs>--><?php //echo $data['html_block'];?><!--</div>-->
        <pre><code><?php echo $data['html_block'];?></code></pre>
    </div>
</div>
