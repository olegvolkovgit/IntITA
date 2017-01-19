<span  ng-if="module.modulePrice==0" class="colorGreen"><?= Yii::t('module', '0421') ?></span>
<span ng-if="module.modulePrice!=0">
    <span ng-if="module.idCourse">
        <span id="oldPrice">{{module.module.module_price}}<?= Yii::t('module', '0222') ?></span>
        {{module.modulePrice}}<?= Yii::t('module', '0222') ?>(<?= Yii::t('module', '0223') ?>)
    </span>
    <span ng-if="!module.idCourse">
        <span>{{module.modulePrice}}<?= Yii::t('module', '0222') ?></span>
    </span>
</span>
