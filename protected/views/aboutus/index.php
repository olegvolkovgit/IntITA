<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 15.03.2015
 * Time: 18:08
 */
?>

<body onload=WindowShow(<?php echo (empty($_GET['id']))?1:$_GET['id']; ?>);>
</body>
<?php
/*$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0051'),
);*/
$this->pageTitle = Yii::t('mainpage','0001');
$headerText = Yii::t('mainpage','0002');
$subheaderText = Yii::t('mainpage','0006');
$subLineImage = $mainpage['subLineImage'];
$dropName = Yii::t('mainpage','0004');
$massAbout = array($block1,$block2,$block3);
?>

<?php $this->renderPartial("_slider"); ?>

<?php $this->renderPartial('_shortBlocks', array('subLineImage' => $subLineImage, 'massAbout' => $massAbout));?>
<?php $this->renderPartial('_aboutDetail', array('block1' => $block1, 'block2' => $block2, 'block3' => $block3));?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/jquery.scrollTo-min.js"></script>