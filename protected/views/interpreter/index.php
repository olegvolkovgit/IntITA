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
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/directives/interpreterForms.js'); ?>"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'interpreter.css'); ?>"/>
<script>
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<input type="hidden" ng-init="etalon=<?php echo htmlspecialchars(json_encode($_POST["etalon"])) ?>" ng-model="etalon" />
<input type="hidden" ng-init='lang=<?php echo htmlspecialchars(json_encode($_POST["lang"])); ?>' ng-model="lang" />
<input type="hidden" ng-init='task=<?php echo time(); ?>' ng-model="task" />
<input type="hidden" ng-init="interpreterServer=<?php echo htmlspecialchars(json_encode(Config::getInterpreterServer())); ?>" ng-model="interpreterServer" />
<body ng-app="interpreterApp">
<div ng-controller="interpreterCtrl">
    <form name="interpreterForm">
        <h2 id="title">Params</h2>
        <div ng-repeat="form in args track by $index">
            <params-form/>
        </div>
        <h2 id="title">Unit tests[{{units.length}}]</h2>
        <div ng-repeat="unit in units track by $index">
            <unit-form/>
        </div>
        <h2 id="title">Result</h2>
        <div>
            <result-form/>
        </div>
        <label>Show JSON: <input type="checkbox" ng-model="checked" ng-init="checked=false" /></label><br/>
        <div ng-if="checked">
            <pre>{{res_finalResult | json}}</pre>
        </div>
    </form>
</div>
</body>
