<?php

class CoursePath extends Path{
    public $course;
    public $module;
    public $lecture;
    public $lang;
    public $page;
    public $isPageDefined;

    function init(){
        $course = null;
        $module = null;
        $lecture = null;
        $lang = null;
        $page = null;
    }

    public function parseUrl(){

        $this->getCourse();
        if($this->course != null) {
            if($this->course->isDeleted()){
                throw new \application\components\Exceptions\IntItaException(403, Yii::t('exception', '0866'));
            }
            if($this->course->language != $this->lang){
                throw new \application\components\Exceptions\IntItaException(404);
            }
            $this->getModule();
            if($this->module != null) {
                if(!$this->course->isContain($this->module)){
                    throw new \application\components\Exceptions\IntItaException(403, Yii::t('exception', '0867'));
                }

                $this->getLecture();
                $this->checkPageDefined();

                if($this->lecture == null) {
                    if($this->getLectureOrder()) {
                        throw new \application\components\Exceptions\IntItaException(404);
                    }
                }
            }
        }
        return $this;
    }

    private function getCourse(){
        if (!in_array($this->pathArray[1], array('ru', 'ua', 'en'))){
            $this->course = Course::model()->find(array(
                'condition' => 'alias = :alias',
                'params' => array('alias' => $this->pathArray[1]),
            ));
        } else {
            $this->lang = $this->pathArray[1];
            $this->course = Course::model()->find(array(
                'condition' => 'alias = :alias',
                'params' => array('alias' => $this->pathArray[2]),
            ));
        }
    }

    private function getModule(){
        $moduleAlias = $this->getModuleAlias();
        if (!is_null($moduleAlias)) {
            $this->module = Module::getModuleByAlias($moduleAlias, $this->course->course_ID);
        }
    }

    private function getLecture(){
        $lectureOrder = $this->getLectureOrder();

        if (!is_null($lectureOrder)) {
            $this->lecture = Lecture::getLectureIdByModuleOrder($this->module->module_ID, $lectureOrder);
        }
    }

    private function getModuleAlias(){
        if (is_null($this->lang)){
            if (isset($this->pathArray[2])) {
                return $this->pathArray[2];
            }
        } else {
            if (isset($this->pathArray[3])) {
                return $this->pathArray[3];
            }
        }
        return null;
    }

    private function getLectureOrder(){
        if (is_null($this->lang)){
            if (isset($this->pathArray[3])) {
                return $this->pathArray[3];
            }
        } else {
            if (isset($this->pathArray[4])) {
                return $this->pathArray[4];
            }
        }
        return null;
    }

    public function getType(){
        return 'course';
    }

    public function checkPageDefined(){
        if (is_null($this->lang)){
            if (count($this->pathArray) == 5) {
                $this->page = $this->pathArray[4];
                $this->isPageDefined = true;
            } else {
                $this->isPageDefined = false;
            }
        } else {
            if (count($this->pathArray) == 6) {
                $this->page = $this->pathArray[5];
                $this->isPageDefined = true;
            } else {
                $this->isPageDefined = false;
            }
        }
        return false;
    }
}