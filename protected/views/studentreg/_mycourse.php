<p class="tabHeader"><?php echo Yii::t('profile', '0108'); ?></p>
<div class="profileCourse">
    <table>
        <tr>
            <td>
                <p style="margin-left: 35px"><?php echo Yii::t('profile', '0118'); ?></p>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/course"><span class="colorP">"Апгрейд головного мозку" </span></a>
            </td>
            <td>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/actualcourse.png"/>

            </td>
        </tr>
    </table>
    <p class="courseLevLang"><?php echo Yii::t('courses', '0068'); ?><span class="colorP"><?php echo Yii::t('profile', '0135'); ?></span></p>
    <p class="courseLevLang"><?php echo Yii::t('courses', '0069'); ?><span class="colorP"><?php echo Yii::t('profile', '0136'); ?></span></p>
</div>
<div class="profileModule">
    <p><?php echo Yii::t('lecture', '0072'); ?></br> <a href="<?php echo Yii::app()->request->baseUrl; ?>/module"><span class="colorP">Модуль 4. Модульне око, модульний ніс</span></a></p>
</div>
<div class="profileLesson">
    <p><?php echo Yii::t('lecture', '0073'); ?></br> <a href="<?php echo Yii::app()->request->baseUrl; ?>/lesson"><span class="colorP">Заняття 6. Повторіння мать учіння</span></a></p>
</div>
<div style="border-bottom:none" class="profileCourse">
    <table>
        <tr>
            <td>
                <p style="margin-left: 35px"><?php echo Yii::t('profile', '0119'); ?></p>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/course"><span class="colorP">"Як прокачати ельфа до 81-го рівня" </span></a>
            </td>
            <td>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/incompletecourse.png"/>
            </td>
        </tr>
    </table>
    <div class="studPay">
        <p><?php echo Yii::t('profile', '0121'); ?> 30.12.2015</p>
        <p><?php echo Yii::t('profile', '0122'); ?> 1000 <?php echo Yii::t('profile', '0123'); ?></p>
    </div>
</div>
<div style="border-bottom:none" class="profileCourse">
    <table>
        <tr>
            <td>
                <p style="margin-left: 35px"><?php echo Yii::t('profile', '0120'); ?></p>
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/course"><span class="colorP">"Відкрий у собі гобліна"</span></a>
            </td>
            <td>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/completecourse.png"/>
            </td>
        </tr>
    </table>
</div>