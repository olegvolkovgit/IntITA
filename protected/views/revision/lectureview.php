<?php
    //todo
$this->breadcrumbs = array(
    'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $lectureRevision->id_module)),
    'Ревізії занять модуля' => Yii::app()->createUrl('/revision/ModuleLecturesRevisions', array('idModule'=>$lectureRevision->id_module)),
    'Ревізія даного заняття',
);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_edit/controllers/lectureRevisionCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<script>
    idRevision = '<?php echo $idRevision;?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<div ng-app="lectureRevision">
    <div ng-controller="lectureRevisionCtrl">
        <div id="revisionMainBox">
            <label>Властивоті лекції: </label>

            <table class="table">
                <tr>
                    <td>Модуль</td>
                    <td><?=$lectureRevision->id_module?></td>
                </tr>
                <tr>
                    <td>Номер ревізії</td>
                    <td><?=$lectureRevision->id_revision?></td>
                </tr>
                <tr>
                    <td>Назва (укр)</td>
                    <td><?=$lectureRevision->properties->title_ua?></td>
                </tr>
                <tr>
                    <td>Назва (рос)</td>
                    <td><?=$lectureRevision->properties->title_ru?></td>
                </tr>
                <tr>
                    <td>Назва (англ)</td>
                    <td><?=$lectureRevision->properties->title_en?></td>
                </tr>
                <tr>
                    <td>Автор</td>
                    <td><?=$lectureRevision->properties->id_user_created?></td>
                </tr>
                <tr>
                    <td>Поточний статус</td>
                    <td><?=$lectureRevision->getStatus()?></td>
                </tr>
            </table>
            <div ng-if="dataPages[0].editor && dataPages[0].editable">
                <button ng-click="addPage();">Додати сторінку</button>
                <button ng-click="checkLecture();">Перевірити лекцію на наявність конфліктів</button>
                <button ng-click="approveLecture();">Відправити лекцію на затвердження</button>
            </div>
            <br>

            <label>Перелік ревізій сторінок лекції: </label>

            <table id="pages" class="table">
                <tr>
                    <td>Номер ревізії</td>
                    <td>Назва</td>
                    <td>Порядковий номер</td>
                    <td>Навігація</td>
                </tr>
                <tr ng-repeat="page in dataPages track by $index">
                    <td>{{page.id}}</td>
                    <td>{{page.page_title}}</td>
                    <td>{{page.page_order}}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Дії <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a ng-click="viewPage(page.id)">Переглянути</a></li>
                                <li ng-if="page.editor && page.editable"><a ng-click="editPageRevision(page.id)">Редагувати</a></li>
                            </ul>
                        </div>
                        <div style="display: inline-block" ng-if="page.editor && page.editable">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'up.png');?>" class="editIco" ng-click="up(page.id);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'down.png');?>" class="editIco" ng-click="down(page.id);">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" class="editIco" ng-click="delete(page.id);">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'revision.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>"
<br>
