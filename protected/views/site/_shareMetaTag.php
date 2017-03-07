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
<div id="sharingMain" class="big_icon">
    <div class="share42init"  data-top1="110" data-top2="70" data-margin="15"
         data-url="<?php echo $url ?>"
         data-title="<?php echo $title ?>"
         data-image="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg') ?>"
         data-description="<?php echo $description ?>"
         data-path="<?php echo Config::getBaseUrl(); ?>/scripts/share42/"
         data-icons-file="icons.png"
         data-zero-counter="1">
    </div>
</div>
<div id="sharingMain" class="less_icon" style="display: none">
    <div class="share42init"  data-top1="110" data-top2="70" data-margin="22"
         data-url="<?php echo $url ?>"
         data-title="<?php echo $title ?>"
         data-image="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg') ?>"
         data-description="<?php echo $description ?>"
         data-path="<?php echo Config::getBaseUrl(); ?>/scripts/share42/"
         data-icons-file="little_icons.png"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'share42/share42.js'); ?>"></script>
<script>
    window.addEventListener("load", loadFunction);
    window.addEventListener("resize", myFunction);

    function defineSizeIcons() {
        var height_page = document.documentElement.clientHeight;
        var height_el = 400;
        var big_icon = document.getElementsByClassName('big_icon')[0];
        var less_icon = document.getElementsByClassName('less_icon')[0];

        if(height_page < height_el){
            big_icon.style.display = 'none';
            less_icon.style.display = 'block';
            var less_icon = document.getElementsByClassName('less_icon')[0];
            var little_icon = less_icon.getElementsByClassName('share42-item');

            for(var i = 0; i < little_icon.length; i++) {
                little_icon[i].style.height = '34px';
                var little_icon_a = little_icon[i].getElementsByTagName('a')[0];
                little_icon_a.style.height = '33px';
                little_icon_a.style.width = '31.55px';
                little_icon_a.style.backgroundPositionX = -31.5*i + 'px';
            }
        } else if (height_el < height_page){
            less_icon.style.display = 'none';
            big_icon.style.display = 'block';
        }
    }
    function loadFunction() {
        defineSizeIcons();
    }

    function myFunction() {
        defineSizeIcons();
    }
</script>