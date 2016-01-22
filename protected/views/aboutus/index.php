<?php
$mainpage = new Mainpage();
$headerText = $mainpage->getHeader1();
$subheaderText = $mainpage->getSubheader1();

 $this->renderPartial("_slider", array('slider' => $slider)); ?>

 <http>
	<!-- ... -->

	<headers defaults-disabled="true">
		<cache-control/>
		<frame-options policy="SAMEORIGIN" />
		<hsts disable="true"/>
	</headers>
</http>


       <iframe  src="http://localhost:8080" scrolling="no" id="idIframe"  width="100%" height=3000px  style="border:0" onLoad="resizeIframe();"></iframe>
	   <? $css_version = 1; ?>
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'aboutusstyles.css'); ?>"/>
    <body onload=WindowShow(<?php echo (empty($_GET['id'])) ? 1 : $_GET['id']; ?>);>
    </body>
 
<?php $this->renderPartial('_shortBlocks', array('massAbout' => $arrayAboutUs)); ?>
<?php $this->renderPartial('_aboutDetail', array(
    'block1' => $arrayAboutUs[0],
    'block2' => $arrayAboutUs[1],
    'block3' => $arrayAboutUs[2]
)); ?>

<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url' => Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title' => Yii::t('mainpage', '0002') . '. ' . Yii::t('sharing', '0643'),
    'description' => Yii::t('sharing', '0644'),
));
?>