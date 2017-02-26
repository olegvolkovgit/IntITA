<?php

class HeaderController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

    public function currentPag() {
        $array_url_name = ['/courses', '/teachers', '/graduate', '/aboutus', ];
        $url_name = Config::getBaseUrl();
        $data = $url_name;
        var_dump($data);
        echo json_encode($data);
    }
}