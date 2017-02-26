<?php
$this->breadcrumbs = array(
    'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $moduleRevision->id_module)),
    'Ревізії модуля' => Yii::app()->createUrl('/moduleRevision/moduleRevisions', array('idModule'=>$moduleRevision->id_module)),
    'Ревізія даного модуля',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/controllers/moduleRevisionCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/module_revision_app/services/moduleRevisionsActions.js'); ?>"></script>
<script>
    idRevision = '<?php echo $moduleRevision->id_module_revision;?>';
    idModule = '<?php echo $moduleRevision->id_module;?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<div ng-controller="moduleRevisionCtrl">
    <div ng-cloak id="revisionMainBox">
        <?php
            $this->renderPartial('_moduleRevisionInfo', array('moduleRevision' => $moduleRevision));
        ?>
        <button class="btn btn-primary" ng-click="checkModuleRevision();">Наявність конфліктів</button>
        <?php if($author) { ?>
            <div>
                <a href="" ng-click="isOpenLecture = !isOpenLecture">Створити ревізію нового заняття</a>
            </div>
            <div ng-show="isOpenLecture">
                <?php $this->renderPartial('/revision/_addLessonForm', array('idModule'=>$moduleRevision->id_module)); ?>
            </div>
        <?php } ?>
        <h3>Доступні ревізії занять:</h3>
        <div class="revisionTable">
            <label>Доступні ревізії занять данного модуля(запропоновані до релізу, в релізі, затверджені):</label>
            <div class="form-group">
                <label>
                    <input type="checkbox" ng-init="current.proposed_to_release=true" ng-model="current.proposed_to_release">Запропоновані до релізу
                </label>
                <label>
                    <input type="checkbox" ng-model="current.released">В релізі
                </label>
                <label>
                    <input type="checkbox" ng-model="current.approved">Затверджені
                </label>
            </div>
            <div class="revisionsList">
                <div ng-if="current.proposed_to_release" ng-repeat="revision in approvedLecture.current.proposed_to_release track by $index">
                    <a ng-href="{{revision.link}}" target="_blank" ng-class="{notActive: !revision.author}">
                        Ревізія №{{revision.id_lecture_revision}} {{revision.title}}
                    </a>
                    <span class='ico' ng-click="addRevisionToModuleFromCurrentList(revision.id_revision, $index, revisionProposedToRelease)">+</span>
                </div>
                <div ng-if="current.released" ng-repeat="revision in approvedLecture.current.released track by $index">
                    <a ng-href="{{revision.link}}" target="_blank" ng-class="{notActive: !revision.author}">
                        Ревізія №{{revision.id_lecture_revision}} {{revision.title}}
                    </a>
                    <span class='ico' ng-click="addRevisionToModuleFromCurrentList(revision.id_revision, $index, revisionReleased)">+</span>
                </div>
                <div ng-if="current.approved" ng-repeat="revision in approvedLecture.current.approved track by $index">
                    <a ng-href="{{revision.link}}" target="_blank" ng-class="{notActive: !revision.author}">
                        Ревізія №{{revision.id_lecture_revision}} {{revision.title}}
                    </a>
                    <span class='ico' ng-click="addRevisionToModuleFromCurrentList(revision.id_revision, $index, revisionApproved)">+</span>
                </div>
            </div>
        </div>
        <div class="revisionTable">
            <label>Доступні ревізії занять інших модулів(запропоновані до релізу, в релізі, затверджені):</label>
            <div class="form-group">
                <label>
                    <input type="checkbox" ng-init="foreign.proposed_to_release=true" ng-model="foreign.proposed_to_release">Запропоновані до релізу
                </label>
                <label>
                    <input type="checkbox" ng-model="foreign.released">В релізі
                </label>
                <label>
                    <input type="checkbox" ng-model="foreign.approved">Затверджені
                </label>
            </div>
            <div class="revisionsList">
                <div ng-if="foreign.proposed_to_release" ng-repeat="revision in approvedLecture.foreign.proposed_to_release track by $index">
                    <a ng-href="{{revision.link}}" target="_blank" ng-class="{notActive: !revision.author}">
                        Ревізія №{{revision.id_lecture_revision}} {{revision.title}}
                    </a>
                    <span class='ico' ng-click="addRevisionToModuleFromForeignList(revision.id_revision, $index, revisionProposedToRelease)">+</span>
                </div>
                <div ng-if="foreign.released" ng-repeat="revision in approvedLecture.foreign.released track by $index">
                    <a ng-href="{{revision.link}}" target="_blank" ng-class="{notActive: !revision.author}">
                        Ревізія №{{revision.id_lecture_revision}} {{revision.title}}
                    </a>
                    <span class='ico' ng-click="addRevisionToModuleFromForeignList(revision.id_revision, $index, revisionReleased)">+</span>
                </div>
                <div ng-if="foreign.approved" ng-repeat="revision in approvedLecture.foreign.approved track by $index">
                    <a ng-href="{{revision.link}}" target="_blank" ng-class="{notActive: !revision.author}">
                        Ревізія №{{revision.id_lecture_revision}} {{revision.title}}
                    </a>
                    <span class='ico' ng-click="addRevisionToModuleFromForeignList(revision.id_revision, $index, revisionApproved)">+</span>
                </div>
            </div>
        </div>
        <br>
        <label>Перелік ревізій занять: </label>

        <table id="pages" class="table">
            <tr>
                <td>Номер ревізії</td>
                <td class="titleCell" >Назва</td>
                <td>Порядок</td>
                <td>Навігація</td>
            </tr>
            <tr ng-repeat="lecture in lectureInModule track by $index">
                <td><span ng-if="lecture.list!='foreign'">{{lecture.id_lecture_revision}}</span></td>
                <td><a ng-href="<?php echo Yii::app()->createUrl("revision/previewLectureRevision", array('idRevision'=>'')) ?>{{lecture.id_lecture_revision}}" >{{lecture.title}}</a></td>
                <td>{{$index+1}}</td>
                <td>
                    <div style="display: inline-block" >
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'up.png');?>" class="editIco" ng-click="upRevisionInModule(lecture.id_lecture_revision, $index);">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png');?>" class="editIco" ng-click="downRevisionInModule(lecture.id_lecture_revision, $index);">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" class="editIco" ng-click="removeRevisionFromModule(lecture.id_lecture_revision, $index);">
                    </div>
                </td>
            </tr>
        </table>
        <button class="btn btn-primary" ng-click="editModuleRevision(lectureInModule)">Зберегти зміни</button>
        <br>
    </div>
    <br>
</div>