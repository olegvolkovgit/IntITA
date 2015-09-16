<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 16:11
 */

class AboutusController extends Controller{

    public function actionIndex()
    {
        $arrayAboutUs = AboutUs::model()->findAll();

        $this->render('index', array(
            'arrayAboutUs'=>$arrayAboutUs,
        ));
    }
}