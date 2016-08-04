<?php
    //todo
$this->breadcrumbs = array(
    'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $lectureRevision->id_module)),
    'Ревізії занять модуля' => Yii::app()->createUrl('/revision/ModuleLecturesRevisions', array('idModule'=>$lectureRevision->id_module)),
    'Ревізії заняття' => Yii::app()->createUrl('/revision/revisionsBranch', array('idRevision'=>$lectureRevision->id_revision)),
    'Ревізія даного заняття',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/lectureRevisionCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/revisionsActions.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/getLectureData.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/directives/ajaxLoader.js'); ?>"></script>
<script>
    idRevision = '<?php echo $lectureRevision->id_revision;?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<div ng-app="lectureRevisionApp">
    <div ng-controller="lectureRevisionCtrl">
        <div ng-cloak id="revisionMainBox">
            <?php
            $this->renderPartial('_lectureInfo', array('lectureRevision' => $lectureRevision));
            ?>
            <div ng-if="lectureData.lecture.canEdit">
                <button class="btn btn-primary" ng-click="addPage();">Додати сторінку</button>
                <button class="btn btn-primary" ng-click="checkLecture();">Наявність конфліктів</button>
            </div>
            <br>

            <label>Перелік ревізій сторінок лекції: </label>

            <table id="pages" class="table">
                <tr>
                    <td>Номер ревізії</td>
                    <td class="titleCell" >Назва</td>
                    <td>Порядок</td>
                    <td>Відео</td>
                    <td class="quizType">Завдання</td>
                    <td>Навігація</td>
                </tr>
                <tr ng-repeat="page in lectureData.pages track by $index">
                    <td ng-click="editPageRevision(page.id)">{{page.id}}</td>
                    <td ng-click="editPageRevision(page.id)">{{page.title}}</td>
                    <td ng-click="editPageRevision(page.id)">{{$index+1}}</td>
                    <td ng-click="editPageRevision(page.id)">{{page.video | videoCheck}}</td>
                    <td ng-click="editPageRevision(page.id)">{{page.quiz | quizType}}</td>
                    <td>
                        <div style="display: inline-block" ng-if="lectureData.lecture.canEdit">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'up.png');?>" class="editIco" ng-click="up(page.id);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png');?>" class="editIco" ng-click="down(page.id);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" class="editIco" ng-click="delete(page.id);">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div data-loading id="loaderContainer">
        <img id="ajaxLoader" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'ajax.gif'); ?>" />
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>"
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'revision.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>

