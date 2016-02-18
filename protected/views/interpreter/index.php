<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 11.12.2015
 * Time: 17:03
 */
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/controllers/interpreterCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/services/sendTaskJsonService.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/services/getTaskJson.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/directives/interpreterForms.js'); ?>"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'interpreter.css'); ?>"/>
<script>
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<input type="hidden" ng-init='lang="<?php echo Task::getTaskLangById($idTask); ?>"' ng-model="lang" />
<input type="hidden" ng-init='task="<?php echo $idTask; ?>"' ng-model="task" />
<input type="hidden" ng-init="interpreterServer=<?php echo htmlspecialchars(json_encode(Config::getInterpreterServer())); ?>" ng-model="interpreterServer" />
<body ng-app="interpreterApp">
<div ng-controller="interpreterCtrl">
    <form name="interpreterForm" ng-cloak>
        <div class="container-fluid">
            <div class="row col header">
                Назва функції
                <input class="form-control" placeholder="Назва функції" ng-model="function.function_name" required />
            </div>
        </div>
        <h2 id="title">Параметри функції</h2>
        <div class="container-fluid">
            <div class="row col">
                <div ng-repeat="form in args track by $index">
                    <params-form/>
                </div>
                <button ng-click="addDellForm(0)" type="button" class="btn btn-default pull-right btnInterp" title="Додати змінну">
                    <span ng-class="'glyphicon-plus'" class="glyphicon glyphicon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
        <h2 id="title">Юніт тести[{{units.length}}]</h2>
        <div ng-repeat="unit in units track by $index">
            <unit-form/>
        </div>
        <div class="container-fluid">
            <button ng-click="addDellFormResult(0)" type="button" class="btn btn-default pull-right btnInterp" title="Додати юніттест">
                <span class="glyphicon-plus glyphicon glyphicon" aria-hidden="true"></span>
            </button>
        </div>
        <div class="container-fluid">
            <h2 id="title">Еталонний код</h2>
            <div class="row col header">
                Еталон(не обов'язкове поле, якщо вказані result value в кожному юніт-тесті)
                <textarea class="form-control" name="etalon" id="etalon" placeholder="Код рішення задачі" rows="2" ng-model="finalResult.etalon" ></textarea>
            </div>
        </div>
        <h2 id="title">Результат</h2>
        <div>
            <result-form/>
        </div>
        <label>Показати JSON: <input type="checkbox" ng-model="checked" ng-init="checked=false" /></label><br/>
        <div ng-if="checked">
            <pre>{{res_finalResult | json}}</pre>
        </div>
    </form>
</div>
</body>
