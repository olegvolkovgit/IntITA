<?php
$this->breadcrumbs = array(
    'Курс' => Yii::app()->createUrl("course/index", array("id" => $courseRevision->id_course)),
    'Ревізії курсу' => Yii::app()->createUrl('/courseRevision/courseRevisions', array('idCourse'=>$courseRevision->id_course)),
    'Ревізія даного курсу',
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
        $this->renderPartial('_courseRevisionInfo', array('courseRevision' => $courseRevision));
        ?>
        <button class="btn btn-primary" ng-click="checkCourseRevision();">Наявність конфліктів</button>
        <div ng-controller="moduleCreateCtrl">
            <h3>Доступні модулі:</h3>
            <button ng-click="showForm()" style="display:block;margin-top: 10px" class="btn btn-primary">Створити новий модуль</button>
            <div id="moduleForm" style="display: none;">
                <?php $this->renderPartial('_addModuleForm'); ?>
            </div>

            <h3>Доступні модулі:</h3>
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
                            ID модуля:{{module.id}} {{module.title}}
                        </a>
                        <span class='ico' ng-click="addRevisionToCourseFromCurrentList(module.id, $index, readyModule,model)">+</span>
                    </div>
                    <div ng-if="current.develop_module" ng-repeat="module in readyModules.current.develop_module track by $index">
                        <a ng-href="{{module.link}}" target="_blank">
                            Модуль ID{{module.id}} {{module.title}}
                        </a>
                        <span class='ico' ng-click="addRevisionToCourseFromCurrentList(module.id, $index, developModule,model)">+</span>
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
                            Модуль ID{{module.id}} {{module.title}}
                        </a>
                        <span class='ico' ng-click="addRevisionToCourseFromForeignList(module.id, $index, readyModule, model)">+</span>
                    </div>
                    <div ng-if="foreign.develop_module" ng-repeat="module in readyModules.foreign.develop_module track by $index">
                        <a ng-href="{{module.link}}" target="_blank">
                            Модуль ID{{module.id}} {{module.title}}
                        </a>
                        <span class='ico' ng-click="addRevisionToCourseFromForeignList(module.id, $index, developModule,model)">+</span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <label>Перелік модулів в ревізії курсу: </label>

<!--        <table id="pages" class="table">-->
<!--            <tr>-->
<!--                <td>Номер модуля</td>-->
<!--                <td class="titleCell" >Назва</td>-->
<!--                <td>Порядок</td>-->
<!--                <td>Навігація</td>-->
<!--            </tr>-->
<!--            <tr ng-repeat="module in moduleInCourse track by $index">-->
<!--                <td><span>{{module.id}}</span></td>-->
<!--                <td><a ng-href="--><?php //echo Yii::app()->createUrl("module/index", array("idModule" => ''))?><!--{{module.id}}" >{{module.title}}<span ng-if="module.cancelled"  class="cancelled">(скасований)</span></a></td>-->
<!--                <td>{{$index+1}}</td>-->
<!--                <td>-->
<!--                    <div style="display: inline-block" >-->
<!--                        <img src="--><?php //echo StaticFilesHelper::createPath('image', 'editor', 'up.png');?><!--" class="editIco" ng-click="upModuleInCourse($index);">-->
<!--                        <img src="--><?php //echo StaticFilesHelper::createPath('image', 'editor', 'down.png');?><!--" class="editIco" ng-click="downModuleInCourse($index);">-->
<!--                        <img src="--><?php //echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?><!--" class="editIco" ng-click="removeModuleFromCourse(module.id, $index);">-->
<!--                    </div>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </table>-->
        <button class="btn btn-primary" ng-click="editCourseRevision(moduleInCourse)">Зберегти зміни</button>
        <br>
    </div>
    <br>
        <div class="container">
            <div class="row">
                <div class="panel-body">
                    <div class="panel panel-info">
                        <div class="panel-heading header-list">
                        <div class="col-md-2 col-xs-2">Номер модуля</div>
                        <div class="col-md-6 col-xs-6">Назва</div>
                        <div class="col-md-2 col-xs-2">Порядок</div>
                        <div class="col-md-2 col-xs-2"></div>
                    </div>
                </div>
                <ul class="list-group" dnd-list dnd-drop="callback({targetList: model, targetIndex: index})"
            >
                    <li class="list-group-item" ng-repeat="item in model track by $index"
                    dnd-draggable="null" dnd-callback="onDrop(model, $index, targetList, targetIndex)">
                        <div class="col-md-2 col-xs-2">
                            {{item.id}}
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <a ng-href="<?php echo Yii::app()->createUrl("module/index", array("idModule" => ''))?>{{item.id}}" >{{item.title}}<span ng-if="module.cancelled"  class="cancelled">(скасований)</span></a>
                        </div>
                        <div class="col-md-2 col-xs-2">
                            {{item.module_order}}
                        </div>
                        <div class="col-md-2 col-xs-2">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png');?>" class="editIco" ng-click="removeModuleFromCourse(item.labelFunc($index)[1].id, $index);">
                        </div>
                    </li>
                </ul>
                    <br>
                    <button class="btn btn-primary" ng-click="editCourseRevision(model)">Зберегти зміни</button>
            </div>
        </div>
    </div>
</div>