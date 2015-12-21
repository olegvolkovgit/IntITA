<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 21.12.2015
 * Time: 17:28
 */

class Paginator {

    private $perPage = 10;
    private $count;
    private $firstPage;
    private $lastPage;
//    private $offset;

    public function __construct($perPage)
    {
//        if(!is_int($count) && is_numeric($count))
//            $count = (int)$count;
        $this->perPage = $perPage;
//        $this->count = $count;
        return $this;
    }

    public function getNextPage(CActiveRecord $class,$pageNumber)
    {
        $className = get_class($class);
        $objects = $className::model()->findAllByAttributes(
            array(

            ),
            array(
                'limit' => $this->perPage,
                'offset' => 0
            ));
        var_dump($objects);die;
    }


}