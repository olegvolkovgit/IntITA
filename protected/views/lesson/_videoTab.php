<?php
/*@var $page LecturePage*/
if ($page->video){
?>
<div class="video">
    <img class="startVideo" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'videoPreview.png'); ?>" alt="" />
    <img class="startVideoHover" src="<?php echo StaticFilesHelper::createPath('image', 'common', 'videoPreviewHover.png'); ?>" alt="" />
</div>
    <script>
        $(document).on('mouseenter', '.video', function (e) {
            $('.startVideoHover').css('opacity',1);
        });
        $(document).on('mouseleave', '.video', function (e) {
            $('.startVideoHover').css('opacity',0);
        });
        $('.video').click(function(){
            $('.video').html('<iframe width="750" height="380" src="<?php echo LectureHelper::getLecturePageVideo($page->id);?>?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>');
        });
    </script>
<?php } else{
    echo Yii::t('lecture', '0639');
}?>

