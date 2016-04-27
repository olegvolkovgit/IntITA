<?php
/**
 * @var $courseModel Course
 * @var $moduleModel Module
 * @var $schema int
 */
?>
<p class="tabHeader"><?php echo Yii::t('profile', '0254'); ?></p>
<div class="FinancesPay">
    <?php
    if ($course > 0 && !UserAgreements::courseAgreementExist(Yii::app()->user->getId(), $course)) {
        if ($module > 0 && !UserAgreements::moduleAgreementExist(Yii::app()->user->getId(), $module)) {
            $moduleModel = Module::model()->findByPk($module);
            echo "<h3>" . Yii::t('payment', '0656') . " №" . $moduleModel->module_number . ". " .
                $moduleModel->getTitle() . "</h3>";
            $this->renderPartial('_paymentsModuleForm', array('module' => $module, 'course' => $course));
        } else {
            $courseModel = Course::model()->findByPk($course);
            echo "<h3>" . Yii::t('payment', '0657') . " №" . $courseModel->course_number . ". " .
                $courseModel->getTitle() . "</h3>";
            $this->renderPartial('_paymentsCourseForm', array('course' => $course, 'schema' => $schema));
        }
    } else {
        if ($module > 0 && !UserAgreements::moduleAgreementExist(Yii::app()->user->getId(), $module)) {
            $moduleModel = Module::model()->findByPk($module);
            echo "<h3>" . Yii::t('payment', '0656') . " №" . $moduleModel->module_number . ". " .
                $moduleModel->getTitle() . "</h3>";
            $this->renderPartial('_paymentsModuleForm', array('module' => $module, 'course' => $course));
        }
    } ?>
</div>

