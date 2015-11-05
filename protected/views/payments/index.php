<?php
    $this->pageTitle = 'INTITA';
?>
    <link type="text/css" rel="stylesheet" href="<?php
    echo StaticFilesHelper::fullPathTo('css', 'paymentsInvoicesList.css'); ?>" />
    <div class="breadcrumbs">
        <?php
        $this->breadcrumbs=array(
            'Договір');
        ?>
    </div>
    <div class="titleAgreement">
        <h1>Рахунки до сплати за договором №<?php echo UserAgreements::getNumber($agreement);?> від
            <?php echo  UserAgreements::getCreateDate($agreement);?></h1>
    </div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'invoices-grid',
    'dataProvider' => $dataProvider,
    'emptyText' => 'Рахунків немає.',
    'summaryText' => '',
    'template'=>'{items}{pager}',
    'pager' => array(
        'firstPageLabel'=>'&#171;&#171;',
        'lastPageLabel'=>'&#187;&#187;',
        'prevPageLabel'=>'&#171;',
        'nextPageLabel'=>'&#187;',
        'header'=>'',
        'cssFile'=>Config::getBaseUrl().'/css/pager.css'
    ),
    'columns' => array(
        array(
            'header' => false,
            'class'=>'CLinkColumn',
            'urlExpression'=>'Yii::app()->createUrl("payments/invoice", array("id"=>$data->id))',
            'htmlOptions'=>array('style'=>'cursor: pointer;'),
            'headerHtmlOptions' => array('style' => 'display:none'),
            'labelExpression' => '"Рахунок №".($row+1).". Сплатити ".
                number_format(PaymentHelper::getPriceUah($data->summa), 2, ",", " ")." грн. до ".$data->payment_date'
        ),
    ),
));
    ?>