<?php
/**
 * @var $agreements
 * @var $courseModel Course
 * @var $moduleModel Module
 */
?>
<p class="tabHeader"><?php echo Yii::t('profile', '0254');?></p>
<div class="FinancesPay">
    <?php
    if($course > 0 && !UserAgreements::courseAgreementExist(Yii::app()->user->getId(), $course)) {
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
    }else {
            if($module > 0 && !UserAgreements::moduleAgreementExist(Yii::app()->user->getId(), $module)){
                $moduleModel = Module::model()->findByPk($module);
                echo "<h3>".Yii::t('payment', '0656')." №" . $moduleModel->module_number.". ".
                    $moduleModel->getTitle(). "</h3>";
                $this->renderPartial('_paymentsModuleForm', array('module' => $module, 'course' => $course));
            }
    ?>
    <br>
    <br>
    <?php }?>
    <p class="payments"><?php echo Yii::t('profile', '0255'); ?></p>
    <table class="payInfo">
        <tr>
            <td>
                <img src="<?php echo StaticFilesHelper::createImagePath('common',  'financeicoGreen.png') ?>"/>
                <span id="full" class='selectedTab' onclick="showFullPay(this)"><?php echo Yii::t('profile', '0256'); ?></span>
            </td>
            <td>
                <img src="<?php echo StaticFilesHelper::createImagePath('common', 'financeicoRed.png'); ?>"/>
                <span id="notfull" class='unselectedTab' onclick="showNotfullPay(this)"><?php echo Yii::t('profile', '0257'); ?></span>
            </td>
            <td>
                <img src="<?php echo StaticFilesHelper::createImagePath('common',  'financeicoGreen.png') ?>"/>
                <span id="agreementsList" class='unselectedTab' onclick="showAgreementsPay(this)"><?php echo Yii::t('profile', '0816'); ?></span>
            </td>
        </tr>
    </table>

    <div class="completely">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$paymentsCourses,
            'itemView'=>'_fullpayments',
            'template'=>'{items}{pager}',
            'emptyText'=>Yii::t("finances", "0543"),
            'pager' => array(
                'firstPageLabel'=>'<<',
                'lastPageLabel'=>'>>',
                'prevPageLabel'=>'<',
                'nextPageLabel'=>'>',
                'header'=>'',
            ),
        ));
        ?>
    </div>
    <div class="partly" style="display: none" >
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$paymentsModules,
            'itemView'=>'_modulespayments',
            'template'=>'{items}{pager}',
            'emptyText'=>Yii::t("finances", "0543"),
            'pager' => array(
                'firstPageLabel'=>'<<',
                'lastPageLabel'=>'>>',
                'prevPageLabel'=>'<',
                'nextPageLabel'=>'>',
                'header'=>'',
            ),
        ));
        ?>
    </div>
    <div class="agreements" style="display: none">
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$agreements,
            'itemView'=>'_agreements',
            'template'=>'{items}{pager}',
            'emptyText'=>"Договорів немає.",
            'pager' => array(
                'firstPageLabel'=>'<<',
                'lastPageLabel'=>'>>',
                'prevPageLabel'=>'<',
                'nextPageLabel'=>'>',
                'header'=>'',
            ),
        ));
        ?>
    </div>
<br>
<br>
</div>
<script>
    function showFullPay(n){
        $('.completely').show('fast');
        $('.agreements').hide('fast');
        $('.partly').hide('fast');
        if(n.className=='unselectedTab'){
            n.className='selectedTab';
            document.getElementById("notfull").className='unselectedTab';
            document.getElementById("agreementsList").className='unselectedTab';
        }
    }
    function showNotfullPay(n){
        $('.partly').show('fast');
        $('.agreements').hide('fast');
        $('.completely').hide('fast');
        if(n.className=='unselectedTab'){
            n.className='selectedTab';
            document.getElementById("full").className='unselectedTab';
            document.getElementById("agreementsList").className='unselectedTab';
        }
    }
    function showAgreementsPay(n){
        $('.agreements').show('fast');
        $('.partly').hide('fast');
        $('.completely').hide('fast');
        if(n.className=='unselectedTab'){
            n.className='selectedTab';
            document.getElementById("full").className='unselectedTab';
            document.getElementById("notfull").className='unselectedTab';
        }
    }
</script>
