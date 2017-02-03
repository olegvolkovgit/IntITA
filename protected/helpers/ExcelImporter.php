<?php

class ExcelImporter extends PHPExcel
{
    private $table_name;
    private $columns_name_line;
    private $filepath;
    private $criteria;

    // Функция преобразования листа Excel в таблицу MySQL, с учетом объединенных строк и столбцов.
    // Значения берутся уже вычисленными. Параметры:
    //     $table_name - имя таблицы MySQL
    //     $columns_name_line - строка с которой начинаем читать столбец
    public function __construct($table_name,$columns_name_line,$filepath)
    {
        $this->table_name = $table_name;
        $this->columns_name_line = $columns_name_line;
        $this->filepath = $filepath;
        parent::__construct();
    }

    public function setCriteria($criteria){
        $this->criteria = $criteria;
    }

    public function importExcelToMySQL(){
        $PHPExcel_file = PHPExcel_IOFactory::load($this->filepath);
        //     $worksheet - 1-й лист Excel
        foreach ($PHPExcel_file->getWorksheetIterator() as $page) {
            $worksheet=$page;
            break;
        }

        // Строка для названий столбцов таблицы MySQL
        $columns_str = "";
        // Количество столбцов на листе Excel
        $columns_count = PHPExcel_Cell::columnIndexFromString($worksheet->getHighestColumn());
        // Перебираем столбцы листа Excel и генерируем строку с именами через запятую
        for ($column = 0; $column < $columns_count; $column++) {
            $columns_str .= $worksheet->getCellByColumnAndRow($column, $this->columns_name_line)->getCalculatedValue() . ",";
        }

        // Обрезаем строку, убирая запятую в конце
        $columns_str = substr($columns_str, 0, -1);
        // Количество строк на листе Excel
        $rows_count = $worksheet->getHighestRow();

        // Перебираем строки листа Excel
        for ($row = $this->columns_name_line + 1; $row <= $rows_count; $row++) {
            // Строка со значениями всех столбцов в строке листа Excel
            $value_str = "";

            // Перебираем столбцы листа Excel
            for ($column = 0; $column < $columns_count; $column++) {
                $cell = $worksheet->getCellByColumnAndRow($column, $row);
                $value_str .= "'" . $cell->getCalculatedValue() . "',";
            }

            // Обрезаем строку, убирая запятую в конце
            $value_str = substr($value_str, 0, -1);

            // Добавляем строку в таблицу MySQLb.

            $sql = "INSERT IGNORE INTO " . $this->table_name . " (" . $columns_str . ") VALUES (" . $value_str . ")";
            Yii::app()->db->createCommand($sql)->execute();
        }

        return true;
    }
}