<p class="tabHeader"><?php echo Yii::t('profile', '0113'); ?></p>
<div>
<?php
if (StudentReg::getRole(Yii::app()->user->id) == 'викладач') {
    $model = Teacher::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
    ?>
    <div class="mainrating">
        <?php
        echo Yii::t('teacher', '0182');
        $rating = $model->rating;
        ?>
        <div class="stars">
            <?php echo RatingHelper::getRating($rating); ?>
        </div>
    </div>
    <div class="myrating">
        <?php
        echo Yii::t('teacher', '0183');
        $knowledge = $model->rate_knowledge;
        ?>
        <div class="stars">
            <?php echo RatingHelper::getRating($knowledge); ?>
        </div>
    </div>
    <div class="myrating">
        <?php
        echo Yii::t('teacher', '0184');
        $efficiency = $model->rate_efficiency;
        ?>
        <div class="stars">
            <?php echo RatingHelper::getRating($efficiency); ?>
        </div>
    </div>
    <div class="myrating">
        <?php
        echo Yii::t('teacher', '0185');
        $relations = $model->rate_relations;
        ?>
        <div class="stars">
            <?php echo RatingHelper::getRating($relations); ?>
        </div>
    </div>
<?php
}
?>
</div>