<?php
$this->breadcrumbs = array(
    'Модуль' => Yii::app()->createUrl("module/index", array("idModule" => $moduleRevision->id_module)),
    'Ревізії модуля' => Yii::app()->createUrl('/moduleRevision/moduleRevisions', array('idModule'=>$moduleRevision->id_module)),
    'Попередній перегляд модуля',
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
        $this->renderPartial('_moduleRevisionPreviewInfo', array('moduleRevision' => $moduleRevision));
        ?>
        <br>
        <label>Перелік ревізій занять: </label>
        <table id="pages" class="table">
            <tr>
                <td>Номер ревізії</td>
                <td class="titleCell" >Назва</td>
                <td>Порядок</td>
            </tr>
            <tr ng-repeat="lecture in lectureInModule track by $index">
                <td><span ng-if="lecture.list!='foreign'">{{lecture.id_lecture_revision}}</span></td>
                <td><a ng-href="<?php echo Yii::app()->createUrl("revision/previewLectureRevision", array('idRevision'=>'')) ?>{{lecture.id_lecture_revision}}" >{{lecture.title}}</a></td>
                <td>{{$index+1}}</td>
            </tr>
        </table>
        <br>
    </div>
</div>
