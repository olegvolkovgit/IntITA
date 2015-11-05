<?php
    $this->pageTitle = 'INTITA';
?>

<h1>Рахунки до сплати за договором №<?php echo UserAgreements::getNumber($agreement);?> від
    <?php echo  UserAgreements::getCreateDate($agreement);?></h1>

<?php
$counter = 0;
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'invoices-grid',
    'dataProvider' => $dataProvider,
    'emptyText' => 'Рахунків не виставлено.',
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
            'header' => 'Рахунок',
            'value' =>  '"Рахунок №".($row+1)',
        ),
        array(
            'header' => 'Сума до сплати',
            'value' => 'number_format(PaymentHelper::getPriceUah($data->summa), 2, ",", " ")." грн."',
        ),
        array(
            'name' => 'Сплатити до',
            'value' => '$data->payment_date',
        ),

        array(
            'class'=>'CButtonColumn',
            'header'=>'Надрукувати',
            'template'=>'{account}',
            'buttons'=>array
            (
                'account' => array
                (
                    'label'=>'  Надрукувати рахунок  ',
                    'url'=>'Yii::app()->createUrl("payments/account", array("id"=>$data->id))',
                ),
            ),
        ),

    ),
));
    ?>