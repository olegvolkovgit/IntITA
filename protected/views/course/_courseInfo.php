<?php
$langParam = CommonHelper::getLanguage();
$forWhom = 'for_whom_' . $langParam;
$whatYouLearn = 'what_you_learn_' . $langParam;
$whatYouGet = 'what_you_get_' . $langParam;
?>
<div class="courseInfo">
    <?php
    $this->renderPartial('_sideBlock', array('model' => $model, 'param' => 'for_whom_' . $langParam));
    $this->renderPartial('_sideBlock', array('model' => $model, 'param' => 'what_you_learn_' . $langParam));
    $this->renderPartial('_sideBlock', array('model' => $model, 'param' => 'what_you_get_' . $langParam));
    ?>
</div>
<script>
    function showBlock(id, item){
        $('.linkDetail').hide();
        $(item).hide();
        $(id).show();
    }
    function hideBlock(id, item){
        $(item).show();
        $('.linkDetail').show();
        $(id).hide();
    }
</script>