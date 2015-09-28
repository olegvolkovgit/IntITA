<p class="tabHeader"><?php echo Yii::t('profile', '0254'); ?></p>
<div class="FinancesPay">
    <p class="payments">Виберіть схему оплати:</p>

    <?php $this->renderPartial('_paymentsForm');?>
    <br>
    <br>
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
