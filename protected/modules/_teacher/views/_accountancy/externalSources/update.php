<?php
/* @var $this ExternalSourcesController */
/* @var $model ExternalSources */

?>

<h1>Редагувати зовнішні джерела  <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>