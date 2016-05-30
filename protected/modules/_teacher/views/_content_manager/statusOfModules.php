<div class="panel panel-default">
    <div class="panel-body">

        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#all" data-toggle="tab">Всі модулі</a>
            </li>
            <li><a href="#without_videos" data-toggle="tab">Модулі без відео</a>
            </li>
            <li><a href="#without_tests" data-toggle="tab">Модулі без тестів</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="all">

                <?php $this->renderPartial('/_content_manager/_allModules', array('filter_id' => '0','id'=>$id));?>
            </div>
            <div class="tab-pane fade" id="without_videos">
                <?php $this->renderPartial('/_content_manager/_modulesWithoutVideos',array('filter_id'=>'1','id'=>$id)); ?>
            </div>
            <div class="tab-pane fade" id="without_tests">
                <?php $this->renderPartial('/_content_manager/_modulesWithoutTests',array('filter_id'=>'2','id'=>$id)); ?>
            </div>
        </div>
    </div>
</div>