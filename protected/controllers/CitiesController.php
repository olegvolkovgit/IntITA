<?php

class CitiesController extends CController {
    /**
     * @example http://intita.project/cities/typeahead?query=a
     * @param $query
     */
    public function actionTypeahead($query) {
        $lang = Yii::app()->language;
        $field = 'title_' . $lang;
        $models = TypeAheadHelper::getTypeahead($query, 'AddressCity', ['title_ua', 'title_ru', 'title_en']);
        $result = [];
        foreach ($models as $model) {
            $result[] = ['id' => $model->id, 'title' => $model->$field];
        }
        $this->renderPartial('//ajax/json', ['body' => json_encode($result)]);
    }

    /**
     * Returns city id and title by id;
     * @example http://intita.project/cities/get?id=1
     * @param $id
     */
    public function actionGet($id) {
        $lang = Yii::app()->language;
        $field = 'title_' . $lang;
        $model = AddressCity::model()->findByPk($id);
        $result = ['id' => $model->id, 'title' => $model->$field];
        $this->renderPartial('//ajax/json', ['body' => json_encode($result, JSON_FORCE_OBJECT)]);
    }
}