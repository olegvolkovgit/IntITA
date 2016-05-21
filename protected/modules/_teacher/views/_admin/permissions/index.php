<div class="panel panel-default">
    <div class="panel-body">
        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#addTeacherModule" data-toggle="tab">Призначити автора модуля</a>
            </li>
            <li><a href="#cancelTeacherModule" data-toggle="tab">Скасувати права автора модуля</a>
            </li>
            <li><a href="#addConsultantModule" data-toggle="tab">Призначити консультанта</a>
            </li>
            <li><a href="#cancelConsultantModule" data-toggle="tab">Скасувати права консультанта</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="addTeacherModule">
                <?php $this->renderPartial('_addTeacherAccess');?>
            </div>
            <div class="tab-pane fade" id="cancelTeacherModule">
                <?php $this->renderPartial('_cancelTeacherAccess');?>
            </div>
            <div class="tab-pane fade" id="addConsultantModule">
                <?php $this->renderPartial('_addConsultantModule');?>
            </div>
            <div class="tab-pane fade" id="cancelConsultantModule">
                <?php $this->renderPartial('_cancelConsultantModule');?>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        if(history.state!=null)
            openTab('#accessTabs', history.state.tab);
    });
</script>
