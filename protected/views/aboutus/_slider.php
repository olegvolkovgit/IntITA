<div class="aboutusslider">
    <div id="slider" class="owl-carousel">
        <?php
        foreach($slider as $key){?>
            <div class="slide">
                <div>
                    <p><?php echo Yii::t('slider', $key->text); ?></p>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'aboutus', $key->pictureUrl); ?>" />
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>




<!--<div class="aboutusslider">-->
<!--    <div id="slider" class="owl-carousel">-->
<!--        <div class="slideAbout">-->
<!--            <div class="abouttext">-->
<!--                <div class="about1">-->
<!--                    <div class="headerAbout">-->
<!--                        --><?php //echo Yii::t("slider", "0549") ?>
<!--                    </div>-->
<!--                    <div class="sliderCenterBoxLine">-->
<!--                        <hr>-->
<!--                    </div>-->
<!--                    <div class="textabout">-->
<!--                        --><?php //echo Yii::t("slider", "0550") ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <img src="--><?php //echo StaticFilesHelper::createPath('image', 'aboutus', '1.jpg'); ?><!--"/>-->
<!--        </div>-->
<!--        <div class="slideAbout">-->
<!--            <div class="abouttext">-->
<!--                <div class="about2">-->
<!--                    <div class="headerAbout">-->
<!--                        --><?php //echo Yii::t("slider", "0549") ?>
<!--                    </div>-->
<!--                    <div class="sliderCenterBoxLine">-->
<!--                        <hr>-->
<!--                    </div>-->
<!--                    <div class="textabout">-->
<!--                        --><?php //echo Yii::t("slider", "0551") ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <img src="--><?php //echo StaticFilesHelper::createPath('image', 'aboutus', '2.jpg'); ?><!--"/>-->
<!--        </div>-->
<!--        <div class="slideAbout">-->
<!--            <div class="abouttext">-->
<!--                <div class="about3">-->
<!--                    <div class="headerAbout">-->
<!--                        --><?php //echo Yii::t("slider", "0549") ?>
<!--                    </div>-->
<!--                    <div class="sliderCenterBoxLine">-->
<!--                        <hr>-->
<!--                    </div>-->
<!--                    <div class="textabout">-->
<!--                        --><?php //echo Yii::t("slider", "0552") ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <img src="--><?php //echo StaticFilesHelper::createPath('image', 'aboutus', '3.jpg'); ?><!--"/>-->
<!--        </div>-->
<!--        <div class="slideAbout">-->
<!--            <div class="abouttext">-->
<!--                <div class="about4">-->
<!--                    <div class="headerAbout">-->
<!--                        --><?php //echo Yii::t("slider", "0549") ?>
<!--                    </div>-->
<!--                    <div class="sliderCenterBoxLine">-->
<!--                        <hr>-->
<!--                    </div>-->
<!--                    <div class="textabout">-->
<!--                        --><?php //echo Yii::t("slider", "0553") ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <img src="--><?php //echo StaticFilesHelper::createPath('image', 'aboutus', '4.jpg'); ?><!--"/>-->
<!--        </div>-->
<!--        <div class="slideAbout">-->
<!--            <div class="abouttext">-->
<!--                <div class="about5">-->
<!--                    <div class="headerAbout">-->
<!--                        --><?php //echo Yii::t("slider", "0549") ?>
<!--                    </div>-->
<!--                    <div class="sliderCenterBoxLine">-->
<!--                        <hr>-->
<!--                    </div>-->
<!--                    <div class="textabout">-->
<!--                        --><?php //echo Yii::t("slider", "0554") ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <img src="--><?php //echo StaticFilesHelper::createPath('image', 'aboutus', '5.jpg'); ?><!--"/>-->
<!--        </div>-->
<!--        <div class="slideAbout">-->
<!--            <div class="abouttext">-->
<!--                <div class="about6">-->
<!--                    <div class="headerAbout">-->
<!--                        --><?php //echo Yii::t("slider", "0549") ?>
<!--                    </div>-->
<!--                    <div class="sliderCenterBoxLine">-->
<!--                        <hr>-->
<!--                    </div>-->
<!--                    <div class="textabout">-->
<!--                        --><?php //echo Yii::t("slider", "0555") ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <img src="--><?php //echo StaticFilesHelper::createPath('image', 'aboutus', '6.jpg'); ?><!--"/>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'slider.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.theme.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.carousel.css') ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.carousel.js'); ?>"></script>
<script src="<?php echo Config::getBaseUrl(); ?>/scripts/slider.js"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'sliderAboutUs.js'); ?>"></script>