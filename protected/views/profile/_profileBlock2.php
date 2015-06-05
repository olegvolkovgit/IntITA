<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 16:56
 */
?>
<div class="TeacherProfileblock2">
    <?php $this->renderPartial('_teacherRate', array('model' => $model)); ?>

    <?php
/**   ljhkhjgjhgkjhgj */
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_responseBlock',
        'template'=>'{items}{pager}',
        'pager' => array(
            'firstPageLabel'=>'<<',
            'lastPageLabel'=>'>>',
            'header'=>'',
        ),
    ));
    ?>


    <div style="position:relative;"><a name="resp" ></a></div>
    <?php $this->renderPartial('_yourResponse', array('model' => $model));?>
</div>