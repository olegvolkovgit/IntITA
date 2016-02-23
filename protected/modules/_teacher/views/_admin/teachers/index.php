<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 22.12.2015
 * Time: 17:07
 */
?>
<div class="col-md-12">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create'); ?>',
                        ' Додати викладача')">
                Додати викладача
            </button>
        </li>
    </ul>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="teachersAdminTable">
                        <thead>
                        <tr>
                            <th>ФІО</th>
                            <th>Email</th>
                            <th>Статус</th>
                            <th>Профіль</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        initTeachersAdminTable();
    });
</script>

<?php
//$this->widget('application.components.MyGridView', array(
//    'id' => 'tmanage',
//    'dataProvider' => $model->search(),
//    'summaryText' => '',
//    'pager' => array(
//        'firstPageLabel' => '&#171;&#171;',
//        'lastPageLabel' => '&#187;&#187;',
//        'prevPageLabel' => '&#171;',
//        'nextPageLabel' => '&#187;',
//        'header' => '',
//        'cssFile' => StaticFilesHelper::fullPathTo('css', 'pager.css'),
//    ),
//    'columns' => array(
//        array(
//            'header' => 'ПІБ',
//            'value' => '"{$data->last_name} {$data->first_name} {$data->middle_name}"',
//        ),
//        'email',
//        array(
//            'header' => 'Статус',
//            'value' => '($data->isPrint == 1)?"активний":"видалено"',
//        ),
//        array(
//            'class' => 'CButtonColumn',
//            'headerHtmlOptions' => array('style' => 'width:80px'),
//            'buttons'=>array(
//                'delete' => array
//                (
//                    'click' => "function(){
//                                    showConfirm('Ви дійсно хочете видалити вчителя?',$(this).attr('href'))
//                                    return false;
//                              }
//                     ",
//                    'label' => 'Видалити',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/delete", array("id"=>$data->primaryKey))',
//                ),
//                'view' => array
//                (
//                    'click'=>"function(){
//                                    $.fn.yiiGridView.update('tmanage', {
//                                        type:'POST',
//                                        url:$(this).attr('href'),
//                                        success:function(data){
//                                                        fillContainer(data);
//                                    }
//                                    })
//                                    return false;
//                              }
//                     ",
//                    'label'=>'Переглянути',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/showTeacher", array("id"=>$data->primaryKey))',
//                ),
//                'update' => array
//                (
//                    'click'=>"function(){
//                                    $.fn.yiiGridView.update('tmanage', {
//                                        type:'POST',
//                                        url:$(this).attr('href'),
//                                        success:function(data){
//                                                        fillContainer(data);
//                                    }
//                                    })
//                                    return false;
//                              }
//                     ",
//                    'label'=>'Редагувати',
//                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/update", array("id"=>$data->primaryKey))',
//                ),
//
//            ),
//    ),
//    ),
//)); ?>

