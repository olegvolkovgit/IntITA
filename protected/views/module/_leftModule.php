<?php
/**
 * @var $post Module
 * @var $isPaidModule bool
 * @var $isPaidCourse bool
 */
if (!Yii::app()->user->isGuest) {
    if (Yii::app()->user->model->isAdmin()) $post->setScenario('canedit');
}
?>
<div class="leftModule">
    <div class="headerLeftModule">
        <?php
        if (!Yii::app()->user->isGuest) {
            if (Yii::app()->user->model->isAdmin())
                $this->renderPartial('_moduleInfoForAdmin', array('post' => $post,'price'=>$price));
            else
                $this->renderPartial('_moduleInfo', array('post' => $post,'price'=>$price));
        } else {
            $this->renderPartial('_moduleInfo', array('post' => $post,'price'=>$price));
        }
        ?>
        <div class="paymentsButtons" ng-controller="moduleCtrl">
            <div class="startModule">
                <?php
                if (Yii::app()->user->isGuest && $post->status == 1 && $post->cancelled == 0) {
                    echo CHtml::button(Yii::t('module', '0279'), array('id' => "paymentButtonModule", 'onclick' => 'openSignIn();'));
                } else {?>
                    <a id="paymentButtonModule"
                       ng-click="redirectToCabinet('payModule',<?php echo $post->module_ID ?>)">
                        <?php echo Yii::t('module', '0279'); ?>
                    </a>
                <?php } ?>
            </div>
            <?php if (isset($_GET['idCourse']) && $_GET['idCourse'] > 0 && Course::getStatus($_GET['idCourse']) == 1) { ?>
                <div class="startCourse">
                    <?php
                    if (Yii::app()->user->isGuest) {
                        echo CHtml::button(Yii::t('module', '0280'), array('id' => "paymentButtonCourse", 'onclick' => 'openSignIn();'));
                    } else if (!$isPaidCourse) {
                        ?>
                        <a id="paymentButtonCourse"
                           ng-click="redirectToCabinet('payCourse',<?php echo $_GET['idCourse'] ?>)">
                            <?php echo Yii::t('course', '0328'); ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
        <?php
        $this->renderPartial('_lectures', array('dataProvider' => $dataProvider, 'canEdit' => $editMode, 'module' => $post, "idCourse" => $idCourse, 'isReadyCourse' => $isReadyCourse, 'isContentManager' => $isContentManager,'price'=>$price)); ?>
    </div>
</div>