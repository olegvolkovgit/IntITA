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
		}else{
			$app->language = 'ua';
		}

        Config::model()->cache(3600)->findAllByAttributes(array('hidden' => 0));
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

	public function behaviors()
	{
		return array(
			'InlineWidgetsBehavior'=>array(
				'class'=>'DInlineWidgetsBehavior',
				'location'=>'application.components.widgets',
				'startBlock'=> '{{w:',
				'endBlock'=> '}}',
				'widgets'=>array(
					'Share',
					'Comments',
					'AuthorizationFormWidget',
				),
			),
		);
	}
        
        public function afterAction($action) {
             $sql = 'INSERT INTO log_actions VALUES '
                     . '(NULL, '
                     . '\''.$this->getId().'\','
                     . '\''.$this->getAction()->getId().'\','
                     . '\''.$_SERVER['REMOTE_ADDR'].'\','
                     . '\''.Yii::app()->user->id.'\','
                     . '\''.implode(', ', array_map(function ($v, $k) { return $k . '=' . $v; }, $this->actionParams, array_keys($this->actionParams))).'\','
                     . '\''.$this->getRoute().'\','
                     . 'CURRENT_TIMESTAMP'
                     . ')';
//                     . '\''.Yii::app()->user->name.'\','
//                     . '\''.$_SERVER['REMOTE_ADDR'].'\','
//                     . '\''.date("Y-m-d H:i:s").'\','
//                     . '\''.$this->getId().'\','
//                     . '\''.$this->getAction()->getId().'\','
//                     . '\''.$this->logMessage.'\')';
                        $command = Yii::app()->db->createCommand($sql);
                        $command->execute();
            return parent::afterAction($action);
        }
}
