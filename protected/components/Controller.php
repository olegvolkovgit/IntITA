<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	public $logoURL;
	public $menu1;
	public $link1;
	public $menu2;
	public $link2;
	public $menu3;
	public $link3;
	public $menu4;
	public $link4;
	public $buttonText;
    public $smallLogoURL;

	public $phone;
	public $imageUp;
	public $mobile;
	public $email;
	public $imageSotial;
    public  $sourceMessages;

	public function init(){
        $header = Header::model()->findByPk(1);
        $footer = Footer::model()->findByPk(1);
        $this->logoURL = Yii::app()->request->baseUrl.$header->logoURL;
        $this->smallLogoURL = Yii::app()->request->baseUrl.$header->smallLogoURL;
        $this->link1 = Yii::app()->request->baseUrl.$header->item1Link;
        $this->link2 = Yii::app()->request->baseUrl.$header->item2Link;
        $this->link3 = Yii::app()->request->baseUrl.$header->item3Link;
        $this->link4 = Yii::app()->request->baseUrl.$header->item4Link;
        $this->imageSotial = Yii::app()->request->baseUrl.$footer->imageSotial;
        $this->imageUp = Yii::app()->request->baseUrl.$footer->imageUp;
		$app = Yii::app();
		if (isset($app->session['lg'])) {
			$app->language = $app->session['lg'];
		}

//        if ($app->session['translatedTable'] == null) {
//            $app->session['translatedTable'] = 'translatedmessagesua';
//        } else {
//            $app->session['translatedTable'] = strtolower($app->session['translatedTable']);
//        }
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
	public $breadcrumbs=array();

	public $seo;
	public $portlets = array();
	public $lastUpdate;
}
