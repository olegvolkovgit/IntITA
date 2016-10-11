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
    private $offset = null;
    private $limit = null;
    private $queryType = null;
    private $defaultModuleSql = ' `module_ID` as id, module.`title_ua` as title, module.language  as language, (SELECT COUNT(*) FROM lectures WHERE module.module_ID = lectures.idModule) AS countOfLectures, (SELECT COUNT(*) FROM lecture_element, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_element.id_lecture AND lecture_element.id_type = 2) AS videos, (SELECT COUNT(*) FROM lecture_element, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_element.id_lecture AND lecture_element.id_type IN (5,6,9,12,13)) AS tests, (SELECT COUNT(*) FROM lecture_page, lectures WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_page.id_lecture) AS parts, (SELECT COUNT(*) FROM vc_lecture WHERE module.module_ID = vc_lecture.id_module) as revisions';
    private $defaultCourseSql = ' course.course_ID as id, course.title_ua as title, course.language AS language, (SELECT COUNT(*) FROM course_modules WHERE course_modules.id_course = course.course_ID) AS modulesCount, (SELECT COUNT(lectures.id) FROM lectures, course_modules WHERE course_modules.id_module = lectures.idModule AND course_modules.id_course = course.course_ID) as countOfLectures, (SELECT COUNT(lecture_element.id_type) FROM lecture_element, course_modules, lectures, module WHERE lecture_element.id_lecture = lectures.id AND lectures.idModule = module.module_ID AND module.module_ID = course_modules.id_module AND course_modules.id_course = course.course_ID AND lecture_element.id_type = 2 ) AS videos, (SELECT COUNT(lecture_element.id_type) FROM lecture_element, course_modules, lectures, module WHERE lecture_element.id_lecture = lectures.id AND lectures.idModule = module.module_ID AND module.module_ID = course_modules.id_module AND course_modules.id_course = course.course_ID AND lecture_element.id_type IN(5,6,9,12,13) ) AS tests, (SELECT COUNT(*) FROM lecture_page, lectures,course_modules,module WHERE module.module_ID = lectures.idModule AND lectures.id = lecture_page.id_lecture AND course_modules.id_module = module.module_ID AND course_modules.id_course = course.course_ID) AS parts, (SELECT COUNT(*) FROM vc_lecture,module,course_modules WHERE module.module_ID = vc_lecture.id_module AND vc_lecture.id_module = module.module_ID AND course_modules.id_module = module.module_ID AND course_modules.id_course = course.course_ID) AS revisions';
    private $selectCommand = null;

    public function __construct($params, $queryType){
        $this->page = key_exists('page', $params) ? $params['page'] : self::DEFAULT_PAGE;
        $this->count = key_exists('count', $params) ? $params['count'] : self::DEFAULT_COUNT;
        $this->type = key_exists('type', $params) ? $params['type']:'all';
        $this->offset = $this->page * $this->count - $this->count;
        $this->limit = $this->count;
        $this->filter = key_exists('filter', $params) ? $params['filter'] : [];
        $this->sorting = key_exists('sorting', $params) ? $params['sorting'] : [];
        $this->queryType = $queryType;
        foreach ($this->filter as $key => $item) {
            $this->filter[$key] = urldecode($item);
        }
        $this->selectCommand = Yii::app()->db->createCommand();
        switch ($this->queryType){
            case 'module':
                $this->selectCommand->select($this->defaultModuleSql)
                    ->from($this->queryType);
                break;
            case 'course':
                $this->selectCommand->select($this->defaultCourseSql)
                    ->from($this->queryType);
                break;
        }
    }

    public function returnData(){

        $rows =[];
        $count = count($this->prepareSqlCommand()->queryAll());
        $rows = $this->prepareSqlCommand()
                ->limit($this->limit)
                ->offset($this->offset)
                ->queryAll();

        return ['count'=>$count, 'rows'=>$rows];
    }

    private function prepareSqlCommand(){
        $command = Yii::app()->db->createCommand();
        $whereParam='';
        switch ($this->type){
            case 'all':
                $command->from('('.$this->selectCommand->text.') stat');
                if (count($this->filter) > 0){
                    $value = '%'.urldecode($this->filter['title']).'%';
                    $whereParam .= ' title LIKE :title';
                    $command->where($whereParam);
                    $command->bindValues([':title'=>$value]);
                }
                break;
            case 'withoutVideos':
                $command->from('('.$this->selectCommand->text.') stat ');
                $whereParam .= ' videos = 0';
                if (count($this->filter) > 0){
                    $value = '%'.urldecode($this->filter['title']).'%';
                    $whereParam .= ' AND title LIKE :title';
                }
                $command->where($whereParam);
                break;
            case 'withoutTests':
                $command->from('('.$this->selectCommand->text.') stat ');
                $whereParam .= ' tests = 0';
                if (count($this->filter) > 0){
                    $value = '%'.urldecode($this->filter['title']).'%';
                    $whereParam .= ' AND title LIKE :title';
                }
                $command->where($whereParam);
                break;
            case 'withoutVideosAndTests':
                $command->from('('.$this->selectCommand->text.') stat ');
                $whereParam .= ' videos = 0 AND tests=0';
                if (count($this->filter) > 0){
                    $value = '%'.urldecode($this->filter['title']).'%';
                    $whereParam .= ' AND title LIKE :title';
                }
                $command->where($whereParam);
                break;
        }
        if (count($this->filter) > 0){
               $command->bindValues([':title'=>$value]);
        }
        return $command;
    }


}