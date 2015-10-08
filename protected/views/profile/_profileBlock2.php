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
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'viewData' => array('teacher'=>$model),
        'itemView'=>'_responseBlock',
        'template'=>'{items}{pager}',
        'emptyText'=>Yii::t('profile', '0195'),
        'pager' => array(
            'firstPageLabel'=>'&#171;&#171;',
            'lastPageLabel'=>'&#187;&#187;',
            'prevPageLabel'=>'&#171;',
            'nextPageLabel'=>'&#187;',
            'header'=>'',
            'cssFile'=>Config::getBaseUrl().'/css/pager.css'
        ),
    ));
    ?>


    <div style="position:relative;"><a name="resp" ></a></div>
    <?php $this->renderPartial('_yourResponse', array('model' => $model, 'response' => $response));?>
</div>