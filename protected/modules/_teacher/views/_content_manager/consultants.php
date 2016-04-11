<div class="panel panel-default">
    <div class="panel-body">
        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#addConsultantModule" data-toggle="tab">Призначити консультанта</a>
            </li>
<!--            <li><a href="#cancelConsultantModule" data-toggle="tab">Скасувати права консультанта</a>-->
<!--            </li>-->
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="addConsultantModule">
                <?php $this->renderPartial('/_content_manager/_addConsultantModule');?>
            </div>
<!--            <div class="tab-pane fade" id="cancelConsultantModule">-->
<!--                --><?php //$this->renderPartial('/_content_manager/_cancelConsultantModule');?>
<!--            </div>-->
        </div>
    </div>
</div>