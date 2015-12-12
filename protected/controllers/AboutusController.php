<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 16:11
 */

class AboutusController extends Controller{

    public function filters()
    {
        return array(
            array(
                'COutputCache',
                'duration'=> 60,
            ),
        );
    }

    public function actionIndex()
    {
        $slider = AboutusSlider::model()->findAll();
        $arrayAboutUs = AboutUs::model()->findAll();
        usort($slider, function($a, $b)
        {
            return strcmp($a->order, $b->order);
        });

        $this->render('index', array(
            'arrayAboutUs'=>$arrayAboutUs,
            'slider' => $slider,
        ));
    }
}