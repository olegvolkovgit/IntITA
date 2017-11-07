<?php
/* @var $agreement UserAgreements */
?>

    <link type="text/css" rel="stylesheet" href="<?=StaticFilesHelper::fullPathTo('css', 'paymentsInvoicesList.css'); ?>"/>
    <div class="breadcrumbs">
        <?php
        $this->breadcrumbs = array('Договір');?>
    </div>
    <div class="titleAgreement">
        <h1>Рахунки до сплати за договором №<?php echo $agreement->number; ?>-<?php echo $agreement->service_id; ?>-<?php echo $agreement->user_id; ?> від
            <?php echo $agreement->create_date; ?></h1>
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
                if ($data->isPaid()) {
                    $class = 'payed';
                } else if ($data->isWaitPaymentDate()) {
                    $class = 'waitPaymentDate';
                } else if ($data->isOverdue()) {
                    $class = 'overdue';
                }

                return $this->renderPartial('_payLink',
                    array(
                        'data' => $data,
                        'cssClass' => $class
                    ), true);
            }
        ),
    ),
]);
?>