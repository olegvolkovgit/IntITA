<div class="panel panel-default">
    <div class="panel-body">
        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#addTeacherModule" data-toggle="tab">Призначити автора модуля</a>
            </li>
            <li><a href="#cancelTeacherModule" data-toggle="tab">Скасувати права автора модуля</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="addTeacherModule">
                <?php $this->renderPartial('/_content_manager/_addTeacherAccess');?>
            </div>
            <div class="tab-pane fade" id="cancelTeacherModule">
                <?php $this->renderPartial('/_content_manager/_cancelTeacherAccess');?>
            </div>
        </div>
    </div>
</div>