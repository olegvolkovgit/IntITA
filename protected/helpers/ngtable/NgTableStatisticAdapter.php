<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 11.10.2016
 * Time: 20:30
 */

class NgTableStatisticAdapter
{

    const DEFAULT_COUNT = 10;
    /**
     *  Default page number
     */
    const DEFAULT_PAGE = 1;

    private $page = 1;
    private $count = 10;
    private $filter = null;
    private $type = 'all';
    private $courseId = 0;
    private $limit = null;
    private $queryType = null;
    private $sorting=null;
    private $defaultModuleSql = ' `module_ID` as id, module.`title_ua` COLLATE utf8_unicode_ci as title  , module.language  as language, (SELECT COUNT(*) FROM lectures WHERE module.module_ID = lectures.idModule) AS countOfLectures, (SELECT COUNT(*) FROM lecture_element, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_element.id_lecture AND lecture_element.id_type = 2) AS videos, (SELECT COUNT(*) FROM lecture_element, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_element.id_lecture AND lecture_element.id_type IN (5,6,9,12,13)) AS tests, (SELECT COUNT(*) FROM lecture_page, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_page.id_lecture) AS parts, (SELECT COUNT(*) FROM vc_lecture WHERE module.module_ID = vc_lecture.id_module) as revisions';
    private $defaultCourseSql = ' course.course_ID as id, course.title_ua COLLATE utf8_unicode_ci as title , course.language AS language, (SELECT COUNT(*) FROM course_modules WHERE course_modules.id_course = course.course_ID) AS modulesCount, (SELECT COUNT(lectures.id) FROM lectures, course_modules WHERE course_modules.id_module = lectures.idModule AND course_modules.id_course = course.course_ID) as countOfLectures, (SELECT COUNT(lecture_element.id_type) FROM lecture_element, course_modules, lectures, module WHERE lecture_element.id_lecture = lectures.id AND lectures.idModule = module.module_ID AND module.module_ID = course_modules.id_module AND course_modules.id_course = course.course_ID AND lecture_element.id_type = 2 ) AS videos, (SELECT COUNT(lecture_element.id_type) FROM lecture_element, course_modules, lectures, module WHERE lecture_element.id_lecture = lectures.id AND lectures.idModule = module.module_ID AND module.module_ID = course_modules.id_module AND course_modules.id_course = course.course_ID AND lecture_element.id_type IN(5,6,9,12,13) ) AS tests, (SELECT COUNT(*) FROM lecture_page, lectures,course_modules,module WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_page.id_lecture AND course_modules.id_module = module.module_ID AND course_modules.id_course = course.course_ID) AS parts, (SELECT COUNT(*) FROM vc_lecture,module,course_modules WHERE module.module_ID = vc_lecture.id_module AND vc_lecture.id_module = module.module_ID AND course_modules.id_module = module.module_ID AND course_modules.id_course = course.course_ID) AS revisions';
    private $selectCommand = null;

    public function __construct($params, $queryType){
        $this->page = key_exists('page', $params) ? $params['page'] : self::DEFAULT_PAGE;
        $this->count = key_exists('count', $params) ? $params['count'] : self::DEFAULT_COUNT;
        $this->type = key_exists('type', $params) ? $params['type']:'all';
        $this->sorting = key_exists('sorting', $params) ? $params['sorting']:null;
        $this->courseId = key_exists('courseId', $params) ? $params['courseId']:0;
        $this->limit = $this->count;
        $this->filter = key_exists('filter', $params) ? $params['filter'] : [];
        $this->queryType = $queryType;
        foreach ($this->filter as $key => $item) {
            $this->filter[$key] = urldecode($item);
        }
        $this->selectCommand = Yii::app()->db->createCommand();
        switch ($this->queryType){
            case 'module':
                $this->selectCommand->select($this->defaultModuleSql)
                    ->from($this->queryType);
                if ($this->courseId) {
                    $this->selectCommand->where('module_ID IN (SELECT course_modules.id_module FROM course_modules WHERE course_modules.id_course = :courseId)',array(':courseId'=>$this->courseId));
                };
                break;
            case 'course':
                $this->selectCommand->select($this->defaultCourseSql)
                    ->from($this->queryType);
                break;
        }
    }

    public function returnData(){
        $command = $this->prepareSqlCommand();
        if (isset($this->sorting)){
            $command->order = key($this->sorting).' '.$this->sorting[key($this->sorting)];
        }
        $rows = $command->queryAll();
        $count = count($rows);
        $page = array_chunk($rows,$this->limit);
        return ['count'=>$count, 'rows'=>(isset($page[$this->page-1]))?$page[$this->page-1]:''];
    }

    private function prepareSqlCommand(){
        $command = Yii::app()->db->createCommand();
        $filters='';
        switch ($this->type){
            case 'all':
                $command->from('('.$this->selectCommand->text.') stat');
                break;
            case 'withoutVideos':
                $command->from('('.$this->selectCommand->text.') stat ');
                $filters .= ' videos = 0';
                break;
            case 'withoutTests':
                $command->from('('.$this->selectCommand->text.') stat ');
                $filters .= ' videos = 0';
                break;
            case 'withoutVideosAndTests':
                $command->from('('.$this->selectCommand->text.') stat ');
                $filters .= ' videos = 0';
                break;
        }

        if (count($this->filter) > 0){
            foreach ($this->filter as $key=>$value){
                $filters .=' AND '.$key.' LIKE :'.$key;
            }
        }
        $valuesToBind=[];
        if ($this->courseId){
            $valuesToBind[':courseId'] = $this->courseId;
        }
        if ($filters !=''){
            $filters = ltrim($filters, ' AND');
            $command->where($filters);
            if (count($this->filter) > 0){
                foreach ($this->filter as $key=>$value){
                    $valuesToBind[':'.$key] = '%'.urldecode($value).'%';
                }
            }
        }
        if (count($valuesToBind)>0)
            $command->bindValues($valuesToBind);
        return $command;
    }


}