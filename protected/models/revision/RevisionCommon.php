<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 23.06.16
 * Time: 22:08
 */
class RevisionCommon {

    /**
     * [
     *   table name =>  [
     *                      join => [direction : 'left', on =>'']
     *                      fields => [field1, field2]
     *                  ],
     * ],
     *
     * [
     *  ['and' => 'field1=1'],
     *  ['or' => 'field1=1']
     * ]
     * @param $fieldsList
     * @param $whereParams
     * @param null $connection
     * @return array
     */

    public function getData($fieldsList, $whereParams, $connection = null) {
        if (!$connection) {
            $connection = Yii::app()->db;
        }

        if (empty($fieldsList)) {
            /*empty data*/
            return [];
        }

        $fields = [];
        $from = [];
        $join = [];

        foreach ($fieldsList as $table => $tableData) {

            if (key_exists('join', $tableData) && !empty($from)) {
                /* join */
                $joinString = $tableData['join']['direction'] . ' JOIN ' . $table . ' ON ' . $tableData['join']['on'];
                array_push($join, $joinString);
            } else {
                /* from */
                array_push($from, $table);
            }

            /* fields */
            if (key_exists('fields', $tableData) && count($tableData['fields'])) {
                $fieldsString = implode(',', array_map(function ($item) use ($table) {
                    return $table . '.' . $item . ' AS ' . $table . '_' . $item;
                }, $tableData['fields']));
            } else {
                $fieldsString = $table . '.*';
            }
            array_push($fields, $fieldsString);
        }

        $where = [];
        
        foreach ($whereParams as $param) {
            $operator = array_keys($param)[0];
            $condition = array_values($param)[0];
            if (!empty($where)) {
                array_push($where, $operator);
            }
            array_push($where, $condition);
        }

        $query = "SELECT " . implode(',', $fields) . " ";
        $query .= "FROM " . implode(',', $from) . " ";
        $query .= implode(',', $join) . " ";
        $query .= 'WHERE ' .implode(' ', $where);

        try {
            $result = $connection->createCommand($query)->queryAll();
        } catch (Exception $e) {
            $result = ['error' => $e];
        }

        return $result;
    }

    /**
     * @param null $idModule
     * @return array
     */
    public function getReleasedLectures($idModule = null) {

        $where = $idModule ? [['and' => 'vc_lecture.id_module = ' . $idModule]] : [];
        array_push($where, ['and' => 'vc_lecture_properties.id_user_released IS NOT NULL']);
        array_push($where, ['and' => 'vc_lecture_properties.id_user_cancelled IS NULL']);

        $data = $this->getData([
            'vc_lecture' => [],
            'vc_lecture_properties' => [
                'join' => [
                    'direction' => 'inner',
                    'on' => 'vc_lecture_properties.id=vc_lecture.id_properties'
                ]
            ]

        ],
            $where);

        return $data;
    }
}