<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    public function init(){
		date_default_timezone_set('UTC');
        if(Config::getMaintenanceMode() == 1){
            $this->renderPartial('/site/notice');
            Yii::app()->cache->flush();
            die();
        }

        $app = Yii::app();
		if (isset($app->session['lg'])) {
			$app->language = $app->session['lg'];
		}

        $items = Config::model()->cache(3600)->findAllByAttributes(array('hidden' => 0));
        $this->pageTitle = Yii::app()->name;
	}
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();

	public $seo;
	public $portlets = array();
	public $lastUpdate;
}
