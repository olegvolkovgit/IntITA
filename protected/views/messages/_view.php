<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('translation')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->translation), array('view', 'id' => $data->translation)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->id0)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('language')); ?>:
	<?php echo GxHtml::encode($data->language); ?>
	<br />

</div>