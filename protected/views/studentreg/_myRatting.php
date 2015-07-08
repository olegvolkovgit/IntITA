<div>
<p class="tabHeader"><?php echo Yii::t('profile', '0113'); ?></p>
<?php
if (AccessHelper::getRole(Yii::app()->user->id) == 'викладач') {
    $model = Teacher::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
    ?>
    <div class="mainrating">
        <?php
        echo Yii::t('teacher', '0182');
        $rating = $model->rating;
        ?>
        <div class="stars">
            <?php
            for ($i = 0; $i < $rating; $i++) {
                ?>
                <span class="courseLevelImage">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png'); ?>">
            </span>
            <?php
            }
            for ($i = $rating; $i < 10; $i++) {
                ?><span class="courseLevelImage">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png'); ?>">
                </span><?php
            }
            ?>
        </div>
    </div>
    <div class="myrating">
        <?php
        echo Yii::t('teacher', '0183');
        $knowledge = $model->rate_knowledge;
        ?>
        <div class="stars">
            <?php
            for ($j = 0; $j < $knowledge; $j++) {
                ?>
                <span class="courseLevelImage">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png'); ?>">
            </span>
            <?php
            }
            for ($j = $knowledge; $j < 10; $j++) {
                ?><span class="courseLevelImage">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png'); ?>">
                </span><?php
            }
            ?>
        </div>
    </div>
    <div class="myrating">
        <?php
        echo Yii::t('teacher', '0184');
        $efficiency = $model->rate_efficiency;
        ?>
        <div class="stars">
            <?php
            for ($k = 0; $k < $efficiency; $k++) {
                ?>
                <span class="courseLevelImage">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png'); ?>">
            </span>
            <?php
            }
            for ($k = $efficiency; $k < 10; $k++) {
                ?><span class="courseLevelImage">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png'); ?>">
                </span><?php
            }
            ?>
        </div>
    </div>
    <div class="myrating">
        <?php
        echo Yii::t('teacher', '0185');
        $relations = $model->rate_relations;
        ?>
        <div class="stars">
            <?php
            for ($r = 0; $r < $relations; $r++) {
                ?>
                <span class="courseLevelImage">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png'); ?>">
            </span>
            <?php
            }
            for ($r = $relations; $r < 10; $r++) {
                ?><span class="courseLevelImage">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png'); ?>">
                </span><?php
            }
            ?>
        </div>
    </div>
<?php
}
?>

<!--</br>-->
<!--<p style="margin-left: 40px">--><?php //echo Yii::t('profile', '0118'); ?><!--</p>-->
<!--<p><span class="colorP">"Розкрій та пошивка дитячих забав. Рівень 3"</span></p>-->
<!--</div>-->
<!--<div class="profileMyRatting">-->
<!--    <p>--><?php //echo Yii::t('profile', '0250'); ?><!-- 1:-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        </br><span class="colorP">Модуль 1. Модульне око, модульний ніс</span></p>-->
<!--</div>-->
<!---->
<!--<div class="profileMyRatting">-->
<!--    <p>--><?php //echo Yii::t('profile', '0250'); ?><!-- 2:-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        </br> <span class="colorP">Модуль 2. Модульне око, модульний ніс</span></p>-->
<!--</div>-->
<!---->
<!--<div class="profileMyRatting">-->
<!--    <p>--><?php //echo Yii::t('profile', '0250'); ?><!-- 3:-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        </br> <span class="colorP">Модуль 3. Модульне око, модульний ніс</span></p>-->
<!--</div>-->
<!---->
<!--<div class="profileMyRatting">-->
<!--    <p>--><?php //echo Yii::t('profile', '0250'); ?><!-- 4:-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        </br> <span class="colorP">Модуль 4. Модульне око, модульний ніс</span></p>-->
<!--</div>-->
<!---->
<!--<div class="profileMyRatting">-->
<!--    <p>--><?php //echo Yii::t('profile', '0250'); ?><!-- 5:-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        </br> <span class="colorP">Модуль 5. Модульне око, модульний ніс</span></p>-->
<!--</div>-->
<!---->
<!--<div class="profileMyRatting">-->
<!--    <p>--><?php //echo Yii::t('profile', '0250'); ?><!-- 6:-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        </br> <span class="colorP">Модуль 6. Модульне око, модульний ніс</span></p>-->
<!--</div>-->
<!---->
<!--<div class="disabledModul">-->
<!--    <p class="disabled" style="margin-left: 40px">-->
<?php //echo Yii::t('profile', '0250'); ?><!-- 7:</br> <span class="disabled">Модуль 7. Модульне око, модульний ніс</span></p>-->
<!--</div>-->
<!---->
<!--<div class="disabledModul">-->
<!--    <p class="disabled" style="margin-left: 40px">-->
<?php //echo Yii::t('profile', '0250'); ?><!-- 8:</br> <span class="disabled">Модуль 8. Модульне око, модульний ніс</span></p>-->
<!--</div>-->
<!---->
<!--<div class="disabledModul">-->
<!--    <p class="disabled" style="margin-left: 40px">-->
<?php //echo Yii::t('profile', '0250'); ?><!-- 9:</br> <span class="disabled">Модуль 9. Модульне око, модульний ніс</span></p>-->
<!--</div>-->
<!---->
<!--<div class="disabledModul">-->
<!--    <p class="disabled" style="margin-left: 40px">-->
<?php //echo Yii::t('profile', '0250'); ?><!-- 10:</br> <span class="disabled">Модуль 10. Модульне око, модульний ніс</span></p>-->
<!--</div>-->
<!---->
<!--<div>-->
<!---->
<!--<p style="margin-left: 35px">--><?php //echo Yii::t('profile', '0120'); ?><!--</p>-->
<!--<p><span class="colorP">"Відкрий у собі гобліна 82 рівня"</span></p>-->
<!--<table>-->
<!--    <tr>-->
<!--        <td>-->
<!--<p><span class="colorP">--><?php //echo Yii::t('profile', '0251'); ?><!--</span></p>-->
<!--        </td>-->
<!--        <td>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        </td></br>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td style="white-space: nowrap">-->
<!--<p><span class="colorP">--><?php //echo Yii::t('profile', '0252'); ?><!--</span></p>-->
<!--        </td>-->
<!--        <td style="white-space: nowrap">-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starFullYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--            <img src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/images/starEmptyYellow.png"/>-->
<!--        </td>-->
<!--        <td>-->
<!--            --><?php //if(StudentReg::getRole(Yii::app()->user->id)==False){
//
?>
<!--                <button class="ButtonRatting" style="margin-left: 150px">-->
<?php //echo Yii::t('profile', '0253'); ?><!--</button>-->
<!--            --><?php
//            }
//
?>
<!--        </td>-->
<!--        </tr>-->
<!--    </table>-->
</div>