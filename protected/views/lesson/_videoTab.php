<!--<div class="fullScreen_button_container">-->
<!--    <button id="changeColor" class="fullScreen" onclick="enterFullscreen('video')" title="Розгорнути"></button>-->
<!--</div>-->
<?php
/* @var $page LecturePage*/
if ($page->video){
?>
<div class="video" ng-click=startLogVideo() start-video='<iframe src="<?php echo $page->getLecturePageVideo();?>?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>' >
    <img class="startVideo" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'videoPreview.png'); ?>" alt="" />
    <img class="startVideoHover" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'videoPreviewHover.png'); ?>" alt="" />
</div>
<?php } else{
    if (isset($message)){
        echo $message;
    } else {
        echo Yii::t('lecture', '0639');
    }
}?>

