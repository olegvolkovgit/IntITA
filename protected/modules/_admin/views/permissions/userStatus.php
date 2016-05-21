<?php
?>
    <link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'access.css'); ?>"/>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/permissions/index'); ?>">Права доступу</a>

    <h2>Статус користувача</h2>
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
                    'url' => 'Yii::app()->createUrl("/_admin/permissions/setUserVerification", array("id"=>$data->id))',
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
                    'url' => 'Yii::app()->createUrl("/_admin/permissions/unsetUserVerification", array("id"=>$data->id))',
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