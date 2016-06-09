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
                $this->renderPartial('_moduleInfoForAdmin', array('post' => $post));
            else
                $this->renderPartial('_moduleInfo', array('post' => $post));
        } else {
            $this->renderPartial('_moduleInfo', array('post' => $post));
        }
        ?>
        <table>
            <tr>
                <td>
                    <div class="startModule">
                        <?php
                        if (Yii::app()->user->isGuest && $post->status == 1 && $post->cancelled == 0) {
                            echo CHtml::button(Yii::t('module', '0279'), array('id' => "paymentButtonModule", 'onclick' => 'openSignIn();'));
                        } else {
                            if ($post->status == 1 && $post->cancelled == 0 && !$isPaidModule) {
                                if ($post->getBasePrice() > 0) {
                                    ?>
                                    <a id="paymentButtonModule" onclick="redirectToProfile()"
                                       href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/index', array(
                                           'scenario' => 'payModule',
                                           'receiver' => 0,
                                           'course' => 0,
                                           'module' => $post->module_ID,
                                       )); ?>"><?php echo Yii::t('module', '0279'); ?></a>
                                <?php } else { ?>
                                    <a id="paymentButtonModule" onclick="signFreeModule(
                                        '<?= Yii::app()->createUrl("module/addAccessFreeModule") ?>',
                                        '<?= Yii::app()->user->getId() ?>',
                                        '<?= $post->module_ID ?>')">
                                        <?php echo Yii::t('module', '0279'); ?>
                                    </a>
                                <?php }
                            }
                        } ?>
                    </div>
                </td>
                <?php if (isset($_GET['idCourse']) && $_GET['idCourse'] > 0 && Course::getStatus($_GET['idCourse']) == 1) { ?>
                    <td>
                        <!--                    <div>-->
                        <!--                    </div>-->
                        <div class="startCourse">
                            <?php
                            if (Yii::app()->user->isGuest) {
                                echo CHtml::button(Yii::t('module', '0280'), array('id' => "paymentButtonCourse", 'onclick' => 'openSignIn();'));
                            } else if (!$isPaidCourse) {
                                ?>
                                <a id="paymentButtonCourse" onclick="redirectToProfile()"
                                   href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/index', array(
                                       'scenario' => 'payCourse',
                                       'receiver' => 0,
                                       'course' => $_GET['idCourse'],
                                       'module' => $post->module_ID,
                                   )); ?>"><?php echo Yii::t('course', '0328'); ?></a>
                                <?php
                            }
                            ?>
                        </div>
                    </td>
                <?php } ?>
            </tr>
        </table>
        <?php
        $this->renderPartial('_lectures', array('dataProvider' => $dataProvider, 'canEdit' => $editMode, 'module' => $post, "idCourse" => $idCourse, 'isReadyCourse' => $isReadyCourse, 'isContentManager' => $isContentManager)); ?>
    </div>
</div>