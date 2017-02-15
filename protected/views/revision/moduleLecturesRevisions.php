<?php
    $this->breadcrumbs = array(
        'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $idModule)),
        'Ревізії занять модуля',
    );
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/services/buildRevisionsTree.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/revisionsTree/revisionTreesCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/revisionsTree/moduleLecturesRevisionsCtrl.js'); ?>"></script>
<script type="text/javascript">
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    idModule = <?php echo $idModule;?>;
    isApprover = '<?php echo $isApprover;?>';
    userId = '<?php echo $userId;?>';
</script>
<div id="revisionMainBox">
    <div class="form-group" ng-controller="revisionTreesCtrl" ng-cloak>
        <div ng-controller="moduleLecturesRevisionsCtrl">
            <a href="" ng-click="isReplyFormOpen = !isReplyFormOpen">Актуальні версії занять (натисніть для відображення)</a>
            <ul ng-show="isReplyFormOpen" class="list-group">
                <li class="list-group-item node-tree" ng-repeat="lecture in currentLectures track by $index">
                    <strong>{{lecture.title}}</strong>
                    <span ng-if="lecture.approvedFromRevision">(Ревізія №{{lecture.approvedFromRevision}})</span>
                    <div class="dropdown treeview-dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            Дії<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li ng-if="lecture.approvedFromRevision">
                                <a ng-click="createRev(lecture.approvedFromRevision)">Створити нову ревізію</a>
                            </li>
                            <li>
                                <a ng-href={{lecture.revisionsLink}} >Переглянути ревізії заняття(створює початкову ревізію, якщо інших немає)</a>
                            </li>
                            <li>
                                <a ng-href={{lecture.lecturePreviewLink}} >Переглянути заняття</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <?php if($author) { ?>
            <div>
                <a href="" ng-click="isOpenLecture = !isOpenLecture">Створити ревізію нового заняття</a>
            </div>
            <div ng-show="isOpenLecture">
                <?php $this->renderPartial('_addLessonForm', array('idModule'=>$idModule)); ?>
            </div>
            <?php } ?>
            <?php
            $this->renderPartial('_revisionsTree');
            ?>
        </div>
    </div>
</div>

