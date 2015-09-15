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
Yii::app()->clientScript->registerMetaTag(StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'), null, null, array('property' => "og:image"));
?>
    <div id="sharing">
        <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
             data-url="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?>"
             data-title="<?php echo Yii::t('mainpage','0002')?>"
             data-image="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg') ?>"
             data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"
             data-path="<?php echo Config::getBaseUrl(); ?>/scripts/share42/"
             data-zero-counter="1">
        </div>
    </div>
    <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/share42/share42.js"></script>
    <body onload=WindowShow(<?php echo (empty($_GET['id'])) ? 1 : $_GET['id']; ?>);>
    </body>
<?php
$this->pageTitle = MainpageHelper::getTitle();
$headerText = MainpageHelper::getHeader1();
$subheaderText = MainpageHelper::getSubheader1();
?>

<?php $this->renderPartial("_slider"); ?>

<?php $this->renderPartial('_shortBlocks', array('massAbout' => $arrayAboutUs)); ?>
<?php $this->renderPartial('_aboutDetail', array('block1' => $arrayAboutUs[0], 'block2' => $arrayAboutUs[1], 'block3' => $arrayAboutUs[2])); ?>