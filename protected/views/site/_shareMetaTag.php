<div style="display: none">
    <h1 itemprop="name"><?php echo $title ?></h1>
    <img itemprop="image" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>"/>
    <p itemprop="description"><?php echo $description ?></p>
</div>
<?php
Yii::app()->clientScript->registerMetaTag($url, null, null, array('property' => "og:url"));
Yii::app()->clientScript->registerMetaTag($title, null, null, array('property' => "og:title"));
Yii::app()->clientScript->registerMetaTag($description, null, null, array('property' => "og:description"));
Yii::app()->clientScript->registerMetaTag($url, null, null, array('property' => "twitter:url"));
Yii::app()->clientScript->registerMetaTag($title, null, null, array('property' => "twitter:title"));
Yii::app()->clientScript->registerMetaTag($title, null, null, array('name' => "title"));
Yii::app()->clientScript->registerMetaTag($description, null, null, array('name' => "description"));
?>
<div id="sharing">
    <div class="share42init" data-top1="70" data-top2="70" data-margin="15"
         data-url="<?php echo $url ?>"
         data-title="<?php echo $title ?>"
         data-image="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg') ?>"
         data-description="<?php echo $description ?>"
         data-path="<?php echo Config::getBaseUrl(); ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'share42/share42.js'); ?>"></script>