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
    function showBlock(id, item, link){
        $(item).hide();
        $(id).show();
        $(link).show();
    }
    function hideBlock(id, item, link){
        $(item).show();
        $(link).show();
        $(id).hide();
    }
</script>