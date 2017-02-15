<?php
$this->breadcrumbs = array(
    'Курс' => Yii::app()->createUrl("course/index", array("id" => $courseRevision->id_course)),
    'Ревізії курсу' => Yii::app()->createUrl('/courseRevision/courseRevisions', array('idCourse'=>$courseRevision->id_course)),
    'Попередній перегляд курсу',
);
?>
<script>
    idRevision = '<?php echo $courseRevision->id_course_revision;?>';
    idCourse = '<?php echo $courseRevision->id_course;?>';
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<div ng-controller="courseRevisionCtrl">
    <div ng-cloak id="revisionMainBox">
        <?php
        $this->renderPartial('_courseRevisionPreviewInfo', array('courseRevision' => $courseRevision));
        ?>
        <br>
        <label>Перелік модулів: </label>
        <table id="pages" class="table">
            <tr>
                <td>Id модуля</td>
                <td class="titleCell" >Назва</td>
                <td>Порядок</td>
            </tr>
            <tr ng-repeat="module in moduleInCourse track by $index">
                <td>{{module.id}}</td>
                <td><a ng-href="<?php echo Yii::app()->createUrl("module/index", array("idModule" => "")) ?>{{module.id}}" >{{module.title}} <span ng-if="module.cancelled"  class="cancelled">(скасований)</span></a></td>
                <td>{{$index+1}}</td>
            </tr>
        </table>
        <br>
    </div>
</div>
