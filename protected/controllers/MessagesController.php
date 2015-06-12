<?php

class MessagesController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Messages'),
		));
	}

	public function actionCreate() {
		$model = new Messages;


		if (isset($_POST['Messages'])) {
			$model->setAttributes($_POST['Messages']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->translation));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Messages');


		if (isset($_POST['Messages'])) {
			$model->setAttributes($_POST['Messages']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->translation));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Messages')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Messages');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Messages('search');
		$model->unsetAttributes();

		if (isset($_GET['Messages']))
			$model->setAttributes($_GET['Messages']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}