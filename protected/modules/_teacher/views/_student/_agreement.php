<?php
/* @var $agreement UserAgreements */
?>
<div class="titleAgreement">
    <h4>Рахунки до сплати за договором №<?php echo $agreement->number; ?> від
        <?= date("d.m.Y", strtotime($agreement->create_date)); ?></h4>
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="invoicesTable">
                    <thead>
                    <tr>
                        <th>Рахунок</th>
                        <th>Сума, грн.</th>
                        <th>Дата</th>
                        <th>Надрукувати</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!---->
<!--    --><?php
//    $invoices = $agreement->invoices();
//    if(count($invoices) > 0){?>
<!--    <div class="list-group">-->
<!--        --><?php //foreach($invoices as $invoice){?>
<!--        <a href="#" class="list-group-item">--><?php //$this->renderPartial('/_student/_payLink',
//                array(
//                    'data' => $invoice,
//                    'cssClass' => $class
//                ), true);?><!--</a>-->
<!--        <a href="#" class="list-group-item">Second item</a>-->
<!--        <a href="#" class="list-group-item">Third item</a>-->
<!--        --><?php //} ?>
<!--    </div>-->
<!--    --><?php //} else {
//    echo "Рахунків немає.";
//    }?>
<?php
////Save $this to use in closures
//$controller = $this;
//$this->widget('zii.widgets.grid.CGridView', ['id' => 'invoices-grid',
//    'dataProvider' => $agreement->invoicesDataProvider(),
//    'emptyText' => 'Рахунків немає.',
//    'summaryText' => '',
//    'template' => '{items}{pager}',
//    'pager' => array(
//        'firstPageLabel' => '&#171;&#171;',
//        'lastPageLabel' => '&#187;&#187;',
//        'prevPageLabel' => '&#171;',
//        'nextPageLabel' => '&#187;',
//        'header' => '',
//        'cssFile' => Config::getBaseUrl() . '/css/pager.css'
//    ),
//    'columns' => array(
//        array(
//            'header' => false,
//            'class' => 'CLinkColumn',
//           // 'urlExpression' => 'Yii::app()->createUrl("/_teacher/_student/student/invoice", array("id"=>$data->id))',
//            'htmlOptions' => array(
//                'style' => 'cursor: pointer;',
//                'onclick' => 'load(basePath + "/_teacher/_student/student/invoice?id=" + $data->id, "Рахунок")'
//                ),
//            'headerHtmlOptions' => array('style' => 'display:none'),
//            'labelExpression' => function (Invoice $data, $row) use ($controller) {
//                $class = 'waiting';
//                if ($data->isPayed()) {
//                    $class = 'payed';
//                } else if ($data->isWaitPaymentDate()) {
//                    $class = 'waitPaymentDate';
//                } else if ($data->isOverdue()) {
//                    $class = 'overdue';
//                }
//
//                return $this->renderPartial('/_student/_payLink',
//                    array(
//                        'data' => $data,
//                        'cssClass' => $class
//                    ), true);
//            }
//        ),
//    ),
//]);
?>
<script>
    initInvoicesTable('<?=$agreement->id?>');
</script>
