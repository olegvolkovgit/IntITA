<?php
/*@var $page LecturePage*/
if ($page->video){
?>
<div class="video">
<iframe width="680" height="400" src="<?php echo LectureHelper::getLecturePageVideo($page->id);?>" frameborder="0" allowfullscreen></iframe>
</div>
<?php } else{
    echo "На жаль, відео для цієї сторінки ще не завантажено.";
}?>