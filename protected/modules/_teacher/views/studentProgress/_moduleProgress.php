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
        <br>
        <div style="padding-left: 15px; color:#4B75A4">
            <i class="fa fa-calculator fa-2x" style="cursor: pointer" aria-hidden="true" title="Підрахувати рейтинг по всіх лекціях"
               ng-click="progress.getAllLecturesRating(stateParams.studentId, stateParams.module)"></i>
        </div>
        <div class="panel-body" class="ng-cloak">
            <content-progress
                    data-template="'<?php echo Config::getBaseUrl() ?>/angular/js/templates/progress/lecturesProgress.html'"
                    data-data-url="'<?php echo Config::getBaseUrl() ?>/_teacher/studentProgress/getModuleProgress'"
                    data-progress=progress
                    data-state-params=stateParams
            >
            </content-progress>
        </div>
    </div>
</div>
