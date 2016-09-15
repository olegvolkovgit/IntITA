<? $css_version = 1; ?>
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'aboutus.css'); ?>"/>
    <script>
        basePath = '<?php echo Config::getBaseUrl(); ?>';
    </script>
    <div ng-controller="aboutUsCtrl" ng-init=windowShow(<?php echo (empty($_GET['id'])) ? 1 : $_GET['id']; ?>); ng-cloak>
        <?php
        $mainpage = new Mainpage();
        $headerText = $mainpage->getHeader1();
        $subheaderText = $mainpage->getSubheader1();

         $this->renderPartial("_slider", array('slider' => $slider)); ?>

        <?php $this->renderPartial('_shortBlocks'); ?>
        <?php $this->renderPartial('_aboutDetail'); ?>
    </div>
<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url' => Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title' => Yii::t('mainpage', '0002') . '. ' . Yii::t('sharing', '0643'),
    'description' => Yii::t('sharing', '0644'),
));
?>