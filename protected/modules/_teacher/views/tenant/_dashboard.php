<div class="row">
    <div class="col-lg-12">
        Tenant
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">

            <div class="panel-body">
                <ul>

                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/consultants'); ?>',
                               'Боти')">Боти</a>
                    </li>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/teacherConsultants'); ?>',
                               'Розмови')">Розмови</a>
                    </li>

                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/statusOfCourses'); ?>',
                               'Типові фрази')">Типові фрази</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>