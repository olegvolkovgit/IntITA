<?php
/* @var $agreement UserAgreements */
?>

    <link type="text/css" rel="stylesheet" href="<?=StaticFilesHelper::fullPathTo('css', 'paymentsInvoicesList.css'); ?>"/>
    <div class="titleAgreement">
        <h4>Рахунки до сплати за договором №<?php echo $agreement->number; ?> від
            <?=date("d.m.Y",strtotime($agreement->create_date));?></h4>
    </div>

<?php
//Save $this to use in closures
$controller = $this;
$this->widget('zii.widgets.grid.CGridView', ['id' => 'invoices-grid',
    'dataProvider' => $agreement->invoicesDataProvider(),
    'emptyText' => 'Рахунків немає.',
    'summaryText' => '',
    'template' => '{items}{pager}',
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => Config::getBaseUrl() . '/css/pager.css'
    ),
    'columns' => array(
        array(
            'header' => false,
            'class' => 'CLinkColumn',
            'urlExpression' => 'Yii::app()->createUrl("payments/invoice", array("id"=>$data->id))',
            'htmlOptions' => array('style' => 'cursor: pointer;'),
            'headerHtmlOptions' => array('style' => 'display:none'),
            'labelExpression' => function (Invoice $data, $row) use ($controller) {
                $class = 'waiting';
                if ($data->isPayed()) {
                    $class = 'payed';
                } else if ($data->isWaitPaymentDate()) {
                    $class = 'waitPaymentDate';
                } else if ($data->isOverdue()) {
                    $class = 'overdue';
                }

                return $this->renderPartial('/_student/_payLink',
                    array(
                        'data' => $data,
                        'cssClass' => $class
                    ), true);
            }
        ),
    ),
]);
?>