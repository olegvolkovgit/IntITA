<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 16:11
 */

class AboutusController extends Controller{

//    public function filters()
//    {
//        return array(
//            array(
//                'COutputCache',
//                'duration'=> 60,
//            ),
//        );
//    }

    public function actionIndex()
    {
        $slider = AboutusSlider::model()->findAll();
        usort($slider, function($a, $b)
        {
            return strcmp($a->order, $b->order);
        });

        $this->render('index', array(
            'slider' => $slider,
        ));
    }

    public function actionGetAboutUsData()
    {
        $arrayAboutUs = AboutUs::model()->findAll();

        $return = array();

        foreach ($arrayAboutUs as $key=>$record) {
            $row = array();
            $row["blockID"] = $record->blockID;
            $row["imageLink"] = StaticFilesHelper::createImagePath('aboutus', $record->iconImage);
            $row["titleText"] = Yii::t('aboutus', $record->titleText);
            $row["textAbout"] = Yii::t('aboutus', $record->textAbout);
            $row["titleTextExp"] = Yii::t('aboutus', $record->titleTextExp);
            $row["tabId"]=AboutUs::getIdTabAboutUs($key);
            array_push($return, $row);
        }

        echo json_encode($return);
    }
}