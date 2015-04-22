<?php
//$sql = "select time1, time2, time3 from timeconsultation";
//$SqldataProvider = new CSqlDataProvider($sql, array(
//    'pagination'=>array(
//        'pageSize'=>14,
//    ),
//));
//$this->widget('zii.widgets.grid.CGridView', array(
//    'id'=>'tablcons',
//    'dataProvider'=>$SqldataProvider,
//    'enablePagination' => true,
//    'columns'=>array(
//        array(
//            'name'=>'time1',
//            'htmlOptions'=>array('style'=>'width: 94px; height: 28px; text-align: center;'),
//        ),
//        array(
//            'name'=>'time2',
//            'htmlOptions'=>array('style'=>'width: 94px; height: 28px; text-align: center;'),
//        ),
//        array(
//            'name'=>'time3',
//            'htmlOptions'=>array('style'=>'width: 94px; height: 28px; text-align: center;'),
//        ),
//    )
//));
//?>
<style>
    #tablcons{
        margin: 0 auto;
        width: 300px;
        height: 500px;
        box-shadow: 0 5px 10px 5px rgba(221, 221, 221, 1);
    }
    div#tablcons{
        display: none;
        position: relative;
        z-index: 3;
    }
    div.summary{
        display: none;
    }
    .grid-view table.items thead{
        display: none;
    }
    .grid-view table.items tr.odd,.grid-view table.items tr.even{
        background: #ffffff;
    }
    .grid-view table.items tr:hover{
        background: #ffffff;
    }
    .grid-view table.items td:hover{
        background: #4B75A4;
        color: #ffffff;
    }
    .grid-view table.items tr.selected td{
        background: #4B75A4;
        color: #ffffff;
    }
</style>
