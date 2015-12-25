<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 22.12.2015
 * Time: 17:56
 */
Yii::import('zii.widgets.grid.CGridView');

class MyGridView extends CGridView {
    /**
     * Renders a table body row.
     * @param integer the row number (zero-based).
     */
//    public function renderTableRow($row)
//    {
//        $data=$this->dataProvider->data[$row];
//        $teacherId = $data->teacher_id;
//        if($this->rowCssClassExpression!==null)
//        {
//            $data=$this->dataProvider->data[$row];
//            echo '<tr class="'.$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data)).'">';
//        }
//        else if(is_array($this->rowCssClass) && ($n=count($this->rowCssClass))>0)
//            echo '<tr onclick="ShowTeacher(\''.Yii::app()->createUrl('/_teacher/_admin/teachers/showTeacher').'\','.$teacherId.')"
//            style="cursor:pointer">';
//        else
//            echo '<tr>';
//
//
//        foreach($this->columns as $column)
//            $column->renderDataCell($row);
//        echo "</tr>\n";
//
//    }

}
