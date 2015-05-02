<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 02.05.2015
 * Time: 17:28
 */
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'filter' => $model,
    'columns' => array(
        array(
            'name' => '',
            'type' => 'raw',
            'value' => '$data->name',
        ),
        array(
            'name' => 'status',
            'type' => 'raw',
            'value' => '$data->status',
        ),
    ),
));