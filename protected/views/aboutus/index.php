<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 15.03.2015
 * Time: 18:08
 */
?>
<?php
Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl(Yii::app()->request->url), null, null, array('property' => "og:url"));
Yii::app()->clientScript->registerMetaTag(Yii::t('mainpage','0002'), null, null, array('property' => "og:title"));
Yii::app()->clientScript->registerMetaTag("Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали", null, null, array('property' => "og:description"));
Yii::app()->clientScript->registerMetaTag('http://intita.itatests.com/images/mainpage/intitaLogo.jpg', null, null, array('property' => "og:image"));
?>
    <div id="sharing">
        <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
             data-url="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?>"
             data-title="<?php echo Yii::t('mainpage','0002')?>"
             data-image='http://intita.itatests.com/images/mainpage/intitaLogo.jpg'
             data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"
             data-path="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/"
             data-zero-counter="1">
        </div>
    </div>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/share42.js"></script>
    <body onload=WindowShow(<?php echo (empty($_GET['id'])) ? 1 : $_GET['id']; ?>);>
    </body>
<?php
/*$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0051'),
);*/
$this->pageTitle = Yii::t('mainpage', '0001');
$headerText = Yii::t('mainpage', '0002');
$subheaderText = Yii::t('mainpage', '0006');
$subLineImage = $mainpage['subLineImage'];
$dropName = Yii::t('mainpage', '0004');
$massAbout = array($block1, $block2, $block3);
?>

<?php $this->renderPartial("_slider"); ?>

<?php $this->renderPartial('_shortBlocks', array('subLineImage' => $subLineImage, 'massAbout' => $massAbout)); ?>
<?php $this->renderPartial('_aboutDetail', array('block1' => $block1, 'block2' => $block2, 'block3' => $block3)); ?>