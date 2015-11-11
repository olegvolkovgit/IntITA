<p class="tabHeader"><?php echo Yii::t('profile', '0254');?></p>
<div class="FinancesPay">
    <?php
    if($course > 0 && !UserAgreements::courseAgreementExist(Yii::app()->user->getId(), $course)) {
        if ($module > 0 && !UserAgreements::moduleAgreementExist(Yii::app()->user->getId(), $module)) {
            echo "<h3>" . Yii::t('payment', '0656') . " №" . ModuleHelper::getModuleNumber($module) . ". " .
                ModuleHelper::getModuleName($module) . "</h3>";
            $this->renderPartial('_paymentsModuleForm', array('module' => $module, 'course' => $course));
        } else {
            echo "<h3>" . Yii::t('payment', '0657') . " №" . CourseHelper::getCourseNumber($course) . ". " .
                CourseHelper::getCourseName($course) . "</h3>";
            $this->renderPartial('_paymentsCourseForm', array('course' => $course, 'schema' => $schema));
        }
    }else {
            if($module > 0 && !UserAgreements::moduleAgreementExist(Yii::app()->user->getId(), $module)){
                echo "<h3>".Yii::t('payment', '0656')." №" . ModuleHelper::getModuleNumber($module).". ".
                    ModuleHelper::getModuleName($module). "</h3>";
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
<br>
<br>
</div>
<script>
    function showFullPay(n){
        $('.completely').show('fast');
        $('.partly').hide('fast');
        if(n.className=='unselectedTab'){
            n.className='selectedTab';
            document.getElementById("notfull").className='unselectedTab';
        }
    }
    function showNotfullPay(n){
        $('.partly').show('fast');
        $('.completely').hide('fast');
        if(n.className=='unselectedTab'){
            n.className='selectedTab';
            document.getElementById("full").className='unselectedTab';
        }
    }
</script>
