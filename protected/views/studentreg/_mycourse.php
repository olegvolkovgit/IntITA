<p class="tabHeader"><?php echo ($owner) ? Yii::t('profile', '0108') : Yii::t('profile', '0822'); ?></p>
<div class="profileCourse">
    <table class="currentCourseTitle">
        <tr>
            <td>
                <p style="margin-left: 35px"><?php echo Yii::t('profile', '0118'); ?></p>
            </td>
            <td>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/actualcourse.png"/>
            </td>
        </tr>
    </table>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$paymentsCourses,
        'itemView'=>'_currentCourse',
        'template'=>'{items}{pager}',
        'emptyText'=>Yii::t('profile', '0831'),
        'pager' => array(
            'firstPageLabel'=>'<<',
            'lastPageLabel'=>'>>',
            'prevPageLabel'=>'<',
            'nextPageLabel'=>'>',
            'header'=>'',
        ),
    ));
    ?>

    <table class="currentCourseTitle">
        <tr>
            <td>
                <p style="margin-left: 35px"><?php echo Yii::t('course', '0330'); ?>:</p>
            </td>
            <td>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/actualcourse.png"/>
            </td>
        </tr>
    </table>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$paymentsModules,
        'itemView'=>'_currentModules',
        'template'=>'{items}{pager}',
        'emptyText'=>Yii::t('profile', '0831'),
        'pager' => array(
            'firstPageLabel'=>'<<',
            'lastPageLabel'=>'>>',
            'prevPageLabel'=>'<',
            'nextPageLabel'=>'>',
            'header'=>'',
        ),
    ));
    ?>
</div>