<?php
/* @var $user RegisteredUser
 * @var $model Teacher
 */
?>
<p class="tabHeader"><?php echo ($owner) ? Yii::t('profile', '0113') : Yii::t('profile', '0823'); ?></p>
<div>
<?php
if ($user->isTeacher()) {
    $model = $user->getTeacher();
    ?>
    <div class="mainrating">
        <?php
        echo Yii::t('teacher', '0182');
        $rating = $model->rating;
        ?>
        <div class="stars">
            <?php echo CommonHelper::getRating($rating); ?>
        </div>
    </div>
    <div class="myrating">
        <?php
        echo Yii::t('teacher', '0183');
        $knowledge = $model->rate_knowledge;
        ?>
        <div class="stars">
            <?php echo CommonHelper::getRating($knowledge); ?>
        </div>
    </div>
    <div class="myrating">
        <?php
        echo Yii::t('teacher', '0184');
        $efficiency = $model->rate_efficiency;
        ?>
        <div class="stars">
            <?php echo CommonHelper::getRating($efficiency); ?>
        </div>
    </div>
    <div class="myrating">
        <?php
        echo Yii::t('teacher', '0185');
        $relations = $model->rate_relations;
        ?>
        <div class="stars">
            <?php echo CommonHelper::getRating($relations); ?>
        </div>
    </div>
<?php
}
?>
</div>