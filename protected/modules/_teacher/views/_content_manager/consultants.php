<div class="panel panel-default">
    <div class="panel-body">
        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#addConsultantModule" data-toggle="tab">Призначити консультанта</a>
            </li>
<!--            <li><a href="#cancelTeacherModule" data-toggle="tab">Скасувати права конусльтанта</a>-->
<!--            </li>-->
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="addConsultantModule">
                <?php $this->renderPartial('../../_admin/permissions/_addConsultantModule');?>
            </div>
<!--            <div class="tab-pane fade" id="cancelTeacherModule">-->
<!--                --><?php //$this->renderPartial('../../_admin/permissions/_cancelTeacherAccess');?>
<!--            </div>-->
        </div>
    </div>
</div>