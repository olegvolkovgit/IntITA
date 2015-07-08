<p class="tabHeader"><?php echo Yii::t('profile', '0109'); ?></p>
<table class="exmCons">
    <tr>
        <td>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/exam.png"/>
        </td>
        <td>
            <?php
            echo CHtml::ajaxLink(
                "<span id='exam' class='unselectedTab' onclick='selectExam(this)'>" . Yii::t('profile', '0111') . "</span>",
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
                "<span id='cons' class='unselectedTab' onclick='selectCons(this)'>" . Yii::t('profile', '0110') . "</span>",
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
                "<span id='imp' class='unselectedTab' onclick='selectImp(this)'>" . Yii::t('profile', '0124') . "</span>",
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
                "<span id='kdp' class='unselectedTab' onclick='selectKdp(this)'>" . Yii::t('profile', '0125') . "</span>",
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
    function selectExam(n) {
        if (n.className == 'unselectedTab') {
            n.className = 'selectedTab';
            document.getElementById("cons").className = 'unselectedTab';
            document.getElementById("imp").className = 'unselectedTab';
            document.getElementById("kdp").className = 'unselectedTab';
        }
    }

    function selectCons(n) {
        if (n.className == 'unselectedTab') {
            n.className = 'selectedTab';
            document.getElementById("exam").className = 'unselectedTab';
            document.getElementById("imp").className = 'unselectedTab';
            document.getElementById("kdp").className = 'unselectedTab';
        }
    }

    function selectImp(n) {
        if (n.className == 'unselectedTab') {
            n.className = 'selectedTab';
            document.getElementById("cons").className = 'unselectedTab';
            document.getElementById("exam").className = 'unselectedTab';
            document.getElementById("kdp").className = 'unselectedTab';
        }
    }

    function selectKdp(n) {
        if (n.className == 'unselectedTab') {
            n.className = 'selectedTab';
            document.getElementById("cons").className = 'unselectedTab';
            document.getElementById("imp").className = 'unselectedTab';
            document.getElementById("exam").className = 'unselectedTab';
        }
    }
</script>