<?php
/**
 * Created by PhpStorm.
 * User: Adm
 * Date: 14.09.2017
 * Time: 12:29
 */
?>
<div class="row">
    <div class="form-group">
        <a type="button" class="btn btn-default" ng-click='back()'>
            Назад
        </a>
    </div>
    <div class="panel panel-default">
        <div class="panel-body" class="ng-cloak">
            <content-progress
                    data-template="'<?php echo Config::getBaseUrl() ?>/angular/js/templates/progress/moduleProgress.html'"
                    data-data-url="'<?php echo Config::getBaseUrl() ?>/_teacher/studentProgress/getCourseProgress'"
                    data-progress=progress
                    data-state-params=stateParams
            >
            </content-progress>
        </div>
    </div>
</div>
