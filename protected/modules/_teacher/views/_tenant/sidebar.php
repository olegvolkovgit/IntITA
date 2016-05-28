<li>
    <a href="#"  onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
        array('page' => 'tenant'));?>','Tenant')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Tenant
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_tenant/tenant/showPhrases'); ?>',
                   'Боти')">
                Боти
            </a>
        </li>
        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_tenant/tenant/SearchChats'); ?>',
                   'Розмови')">
                Розмови
            </a>
        </li>

        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_tenant/tenant/showPhrases'); ?>',
                   'Типові фрази')">
                Типові фрази
            </a>
        </li>
    </ul>
</li>