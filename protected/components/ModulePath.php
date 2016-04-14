<?php

/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 15.09.2015
 * Time: 14:41
 */
class ModulePath extends Path
{
    public $module;
    public $lecture;
    public $lang;
    public $isPageDefined;
    public $page;

    function init()
    {
        $module = null;
        $lecture = null;
        $lang = null;
    }

    public function parseUrl()
    {
        $this->getModule();

        if ($this->module != null) {
            if($this->module->language != $this->lang){
                throw new \application\components\Exceptions\IntItaException(404);
            }

            $this->getLecture();
            $this->checkPageDefined();

            if($this->lecture == null) {
                if($this->getLectureOrder()) {
                    throw new \application\components\Exceptions\IntItaException(404, 'Сторінка не знайдена.');
                }
            }
        }

        return $this;
    }

    private function getModule(){
        $moduleAlias = $this->getModuleAlias();

        if (!is_null($moduleAlias)) {
            $this->module = Module::getModuleByAlias($moduleAlias, null);
        }
    }

    private function getLecture(){
        $lectureOrder = $this->getLectureOrder();

        if (!is_null($lectureOrder)) {
            $this->lecture = Lecture::getLectureIdByModuleOrder($this->module->module_ID, $lectureOrder);
        }
    }

    private function getModuleAlias(){
        if (!in_array($this->pathArray[1], array('ru', 'ua', 'en'))){
            if (isset($this->pathArray[1])) {
                return $this->pathArray[1];
            }
        } else {
            $this->lang = $this->pathArray[1];
            if (isset($this->pathArray[2])) {
                return $this->pathArray[2];
            }
        }
        return null;
    }

    private function getLectureOrder(){
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

    public function getType()
    {
        return 'module';
    }

    public function checkPageDefined(){
        if (is_null($this->lang)){
            if (count($this->pathArray) == 4) {
                $this->page = $this->pathArray[3];
                $this->isPageDefined = true;
            } else {
                $this->isPageDefined = false;
            }
        } else {
            if (count($this->pathArray) == 5) {
                $this->page = $this->pathArray[4];
                $this->isPageDefined = true;
            } else {
                $this->isPageDefined = false;
            }
        }
        return false;
    }
}