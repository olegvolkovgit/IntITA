
    <link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'access.css'); ?>"/>

    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/old/index'); ?>')">
                Права доступу</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/old/showAddAccessForm'); ?>')">
                Додати запис</button>
        </li>
    </ul>
    <div class="page-header">
        <h4>Статус користувача</h4>
    </div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'userStatusGrid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'summaryText' => '',
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => Config::getBaseUrl() . '/css/pager.css'
    ),
    'columns' => array(

        'firstName',
        'secondName',
        'email',
        array(
            'header' => '',
            'value' => 'date("l jS \of F Y h:i:s A", strtotime($data->reg_time))'
        ),
        'status',

        array(
            'class' => 'CButtonColumn',
            'header' => 'Підтвердження реєстрації',
            'template' => '{free} {paid}',
            'buttons' => array
            (
                'free' => array
                (
                    'label' => 'Підтвердити',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/old/setUserVerification", array("id"=>$data->id))',
                    'click' => "function(){
                        $.fn.yiiGridView.update('userStatusGrid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                        $.fn.yiiGridView.update('userStatusGrid');
                        }
                        })
                        return false;
                    }
                    ",
                ),
                'paid' => array
                (
                    'label' => 'Скасувати',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/old/unsetUserVerification", array("id"=>$data->id))',
                    'click' => "function(){
                        $.fn.yiiGridView.update('userStatusGrid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                        $.fn.yiiGridView.update('userStatusGrid');
                        }
                        })
                        return false;
                    }
                    ",
                ),
            ),
        ),
    ),
));
?>