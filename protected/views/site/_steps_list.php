<?php
/**
 * @var $stepsDataProvider CActiveDataProvider
 */
?>
<div class="steps">
    <div class="stepHeaderCont">
        <div class="stepHeader">
            <h1><?php echo $mainpage->getHeader2(); ?></h1>
            <h3><?php echo $mainpage->getSubheader2(); ?></h3>
        </div>
    </div>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $stepsDataProvider,
        'itemView' => '_step',
        'summaryText' => '',
        'id' => "steps_list",
    ));
    ?>
    <div class="bannersArea" ng-cloak>
    <div class="bannersCarousel" ng-controller="bannersSliderCtrl" ng-cloak>
        <ul rn-carousel rn-carousel-index="1" rn-carousel-auto-slide rn-carousel-pause-on-hover rn-carousel-buffered
            rn-carousel-transition="hexagon" rn-carousel-duration="{{slideTime}}">
            <li ng-repeat="slide in slides track by slide.id" ng-class="'id-' + slide.id">
                <a href="{{slide.url}}" target="_blank">
                    <div ng-style="{'background-image': 'url(' + slide.file_path + ')','background-size':'contain', 'background-repeat':'no-repeat' }"
                         class="bannerImage">
                        &nbsp;
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
</div>
