<?php
$this->breadcrumbs = array(
    'Курс' => Yii::app()->createUrl("course/index", array("id" => $courseRevision->id_course)),
    'Ревізії курса' => Yii::app()->createUrl('/courseRevision/courseRevisions', array('idCourse'=>$courseRevision->id_course)),
    'Ревізія даного курса',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/controllers/courseRevisionCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/getCourseData.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/courseRevisionsActions.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/course_revision_app/services/sendCourseRevisionMessage.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<link rel='stylesheet' href="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.css'); ?>" type='text/css' media='all' />
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.js'); ?>"></script>
<script>
    idRevision = '<?php echo $courseRevision->id_course_revision;?>';
    idCourse = '<?php echo $courseRevision->id_course;?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<div ng-app="courseRevisionsApp">
    <div ng-controller="courseRevisionCtrl">
        <div ng-cloak id="revisionMainBox">
            <?php
            $this->renderPartial('_courseRevisionInfo', array('courseRevision' => $courseRevision));
            ?>
            <button class="btn btn-primary" ng-click="checkCourseRevision();">Наявність конфліктів</button>
            <button ng-click="showForm()" style="display:block;margin-top: 10px" class="btn btn-primary">Створити новий модуль</button>
            <div id="moduleForm" style="display: none;">
                <?php $this->renderPartial('_addModuleForm'); ?>
            </div>
            
            <h3>Доступні ревізії занять:</h3>
            <div class="revisionTable">
                <label>Доступні модулі, які входять у даний курс(готові та в розробці):</label>
                <div class="form-group">
                    <label>
                        <input type="checkbox" ng-init="current.ready_module=true" ng-model="current.ready_module">Готові модулі
                    </label>
                    <label>
                        <input type="checkbox" ng-model="current.develop_module">В розробці
                    </label>
                </div>
                <div class="revisionsList">
                    <div ng-if="current.ready_module" ng-repeat="module in readyModules.current.ready_module track by $index">
                        <a ng-href="{{module.link}}" target="_blank">
                            Ревізія №{{module.id}} {{module.title}}
                        </a>
                        <span class='ico' ng-click="addRevisionToCourseFromCurrentList(module.id, $index, readyModule)">+</span>
                    </div>
                    <div ng-if="current.develop_module" ng-repeat="module in readyModules.current.develop_module track by $index">
                        <a ng-href="{{module.link}}" target="_blank">
                            Ревізія №{{module.id}} {{module.title}}
                        </a>
                        <span class='ico' ng-click="addRevisionToCourseFromCurrentList(module.id, $index, developModule)">+</span>
                    </div>
                </div>
            </div>
            <div class="revisionTable">
                <label>Доступні незалежні модулі та модулі інших курсів(готові та в розробці):</label>
                <div class="form-group">
                    <label>
                        <input type="checkbox" ng-init="foreign.ready_module=true" ng-model="foreign.ready_module">Готові модулі
                    </label>
                    <label>
                        <input type="checkbox" ng-model="foreign.develop_module">В розробці
                    </label>
                </div>
                <div class="revisionsList">
                    <div ng-if="foreign.ready_module" ng-repeat="module in readyModules.foreign.ready_module track by $index">
                        <a ng-href="{{module.link}}" target="_blank">
                            Ревізія №{{module.id}} {{module.title}}
                        </a>
                        <span class='ico' ng-click="addRevisionToCourseFromForeignList(module.id, $index, readyModule)">+</span>
                    </div>
                    <div ng-if="foreign.develop_module" ng-repeat="module in readyModules.foreign.develop_module track by $index">
                        <a ng-href="{{module.link}}" target="_blank">
                            Ревізія №{{module.id}} {{module.title}}
                        </a>
                        <span class='ico' ng-click="addRevisionToCourseFromForeignList(module.id, $index, developModule)">+</span>
                    </div>
                </div>
            </div>
            <br>
            <label>Перелік модулів в ревізії курса: </label>

            <table id="pages" class="table">
                <tr>
                    <td>Номер модуля</td>
                    <td class="titleCell" >Назва</td>
                    <td>Порядок</td>
                    <td>Навігація</td>
                </tr>
                <tr ng-repeat="module in moduleInCourse track by $index">
                    <td><span>{{module.id}}</span></td>
                    <td><a ng-href="<?php echo Yii::app()->createUrl("module/index", array("idModule" => ''))?>{{module.id}}" >{{module.title}}<span ng-if="module.cancelled"  class="cancelled">(скасований)</span></a></td>
                    <td>{{$index+1}}</td>
                    <td>
                        <div style="display: inline-block" >
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'up.png');?>" class="editIco" ng-click="upModuleInCourse($index);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png');?>" class="editIco" ng-click="downModuleInCourse($index);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" class="editIco" ng-click="removeModuleFromCourse(module.id, $index);">
                        </div>
                    </td>
                </tr>
            </table>
            <button class="btn btn-primary" ng-click="editCourseRevision(moduleInCourse)">Зберегти зміни</button>
            <br>
        </div>
        <br>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>"
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'revision.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'titleValidation.js'); ?>"></script>
