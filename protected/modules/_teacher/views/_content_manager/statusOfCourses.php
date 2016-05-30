<div class="panel panel-default">
    <div class="panel-body">

        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#all" data-toggle="tab">Всі курси</a>
            </li>
            <li><a href="#without_videos" data-toggle="tab">Курси без відео</a>
            </li>
            <li><a href="#without_tests" data-toggle="tab">Курси без тестів</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="all">
                <?php $this->renderPartial('/_content_manager/_allCourses',array('filter_id'=>'0')); ?>
            </div>
            <div class="tab-pane fade" id="without_videos">
                <?php $this->renderPartial('/_content_manager/_coursesWithoutVideos',array('filter_id'=>'1')); ?>
            </div>
            <div class="tab-pane fade" id="without_tests">
                <?php $this->renderPartial('/_content_manager/_coursesWithoutTests',array('filter_id'=>'2')); ?>
            </div>

        </div>


    </div>
</div>