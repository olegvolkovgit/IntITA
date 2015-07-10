<p class="tabHeader"><?php echo Yii::t('profile', '0109'); ?></p>
<table class="exmCons">
    <tr>
        <td>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/exam.png"/>
        </td>
        <td>
            <?php
            echo CHtml::ajaxLink(
                "<span class='unselectedTab' onclick='selectTab(this)'>" . Yii::t('profile', '0111') . "</span>",
                Yii::app()->createUrl('studentreg/timetableprovider', array('user' => $user->id, 'tab' => 1)),
                array(
                    'update' => '#timetablecontent'
                )
            );
            ?>
        </td>
        <td>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/consultation.png"/>
        </td>
        <td>
            <?php
            echo CHtml::ajaxLink(
                "<span class='unselectedTab' onclick='selectTab(this)'>" . Yii::t('profile', '0110') . "</span>",
                Yii::app()->createUrl('studentreg/timetableprovider', array('user' => $user->id, 'tab' => 2)),
                array(
                    'update' => '#timetablecontent'
                )
            );
            ?>
        </td>
        <td>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/imp.png"/>
        </td>
        <td>
            <?php
            echo CHtml::ajaxLink(
                "<span class='unselectedTab' onclick='selectTab(this)'>" . Yii::t('profile', '0124') . "</span>",
                Yii::app()->createUrl('studentreg/timetableprovider', array('user' => $user->id, 'tab' => 3)),
                array(
                    'update' => '#timetablecontent'
                )
            );
            ?>
        </td>
        <td>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/kdp.png"/>
        </td>
        <td>
            <?php
            echo CHtml::ajaxLink(
                "<span class='unselectedTab' onclick='selectTab(this)'>" . Yii::t('profile', '0125') . "</span>",
                Yii::app()->createUrl('studentreg/timetableprovider', array('user' => $user->id, 'tab' => 4)),
                array(
                    'update' => '#timetablecontent'
                )
            );
            ?>
        </td>
    </tr>
</table>
<div class="consult" id="timetablecontent">
    <div style="display: none">
        <?php $this->renderPartial('_timetableprovider', array('dataProvider' => $dataProvider, 'userId' => $user->id)); ?>
    </div>
</div>
<script>
    function selectTab(n) {
        $('.unselectedTab').removeClass('selectedTab');
        $(n).addClass('selectedTab');
    }
</script>
