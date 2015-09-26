<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 15.03.2015
 * Time: 18:08
 */
?>
<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Yii::t('mainpage','0002'),
    'description'=>'Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали',
));
?>
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