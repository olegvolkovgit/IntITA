<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 24.09.2015
 * Time: 21:20
 */
?>
<div style="display: none">
    <h1 itemprop="name"><?php echo $title ?></h1>
    <img itemprop="image" src="<?php echo $image ?>"></img>
    <p itemprop="description"><?php echo $description ?></p>
</div>
<?php

Yii::app()->clientScript->registerMetaTag($url, null, null, array('property' => "og:url"));
Yii::app()->clientScript->registerMetaTag($title, null, null, array('property' => "og:title"));
Yii::app()->clientScript->registerMetaTag($description, null, null, array('property' => "og:description"));
Yii::app()->clientScript->registerMetaTag($image, null, null, array('property' => "og:image"));
?>
