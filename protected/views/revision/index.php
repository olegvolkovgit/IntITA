<?php
//todo
if(isset($idLecture)){
    $this->breadcrumbs = array(
        'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $idModule)),
        'Ревізії модуля' => Yii::app()->createUrl("revision/moduleLecturesRevisions", array("idModule" => $idModule)),
        'Ревізії занять',
    );
}else if(isset($idModule)){
    $this->breadcrumbs = array(
        'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $idModule)),
        'Ревізії занять модуля',
    );
}else{
    $this->breadcrumbs = array(
        'Усі ревізії занять',
    );
}
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/controllers/revisionTreesCtrl.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-treeview.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lecture_revision_app/directives/ajaxLoader.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<script type="text/javascript">
    basePath='<?php echo  Config::getBaseUrl(); ?>';
    idModule = <?php echo isset($idModule)?$idModule:0;?>;
    idLecture = <?php echo isset($idLecture)?$idLecture:0;?>;
    isApprover = '<?php echo $isApprover;?>';
    userId = '<?php echo $userId;?>';
</script>
<div id="revisionMainBox" ng-app="revisionTreesApp">
    <div class="form-group" ng-controller="revisionTreesCtrl" ng-cloak>
        <?php if(!isset($idLecture) && isset($idModule)){ ?>
            <a href="" ng-click="isReplyFormOpen = !isReplyFormOpen">Актуальні версії занять(натисніть, для відображення)</a>
            <ul ng-show="isReplyFormOpen" class="list-group">
                <li class="list-group-item node-tree" ng-repeat="lecture in currentLectures track by $index">
                    {{lecture.title}} (Порядковий номер: {{lecture.order}})
                    <div class="dropdown treeview-dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            Дії<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a ng-href={{lecture.revisionsLink}} >Переглянути ревізії заняття(створює початкову ревізію, якщо інших немає)</a>
                            </li>
                            <li>
                                <a ng-href={{lecture.lecturePreviewLink}} >Переглянути заняття</a>
                            </li>
    <!--                          <li>-->
    <!--                              <a href="#">Скасувати</a>-->
    <!--                          </li>-->
                            </ul>
                        </div>
                    </li>
            </ul>
        <?php } ?>
        <?php
        $this->renderPartial('_revisionsTree');
        ?>
        <div data-loading id="loaderContainer">
            <img id="ajaxLoader" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'ajax.gif'); ?>" />
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'revision.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrap-treeview.css'); ?>" />

