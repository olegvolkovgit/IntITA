<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 11.12.2015
 * Time: 17:03
 */
?>
<?php header('Access-Control-Allow-Origin: *'); ?>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/controllers/interpreterCtrl.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/services/sendTaskJsonService.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/services/getTaskJson.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/interpreter_app/directives/interpreterForms.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'interpreter.css'); ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">


<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>

<!--codemirror textarea hightlight-->
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/lib/codemirror.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/theme/rubyblue.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'codemirror.css'); ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/lib/codemirror.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/javascript/javascript.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/clike/clike.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/codemirror/mode/php/php.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-ui-codemirror/ui-codemirror.js'); ?>"></script>
<!--codemirror textarea hightlight-->

<script>
    basePath='<?php echo  Config::getBaseUrl(); ?>';
</script>
<input type="hidden" ng-init='idTask="<?php echo $task->id; ?>"' />
<input type="hidden" ng-init='lang="<?php echo $task->language; ?>"' ng-model="lang" />
<input type="hidden" ng-init='task="<?php echo $task->uid; ?>"' ng-model="task" />
<input type="hidden" ng-init="interpreterServer=<?php echo htmlspecialchars(json_encode(Config::getInterpreterServer())); ?>" ng-model="interpreterServer" />
<div ng-controller="interpreterCtrl">
    <form id="interpreterForm" name="interpreterForm" ng-cloak>
        <label>Пам'ятка: <input type="checkbox" ng-model="legend" ng-init="legend=false" /></label><br/>
        <div ng-if="legend">
            <pre>
                <strong>Integer:</strong> ціле число від −2147483648 до 2147483647
                <strong>Float:</strong> від 3.14E-38 до 3.14E+38
                <strong>Bool:</strong> true або false
                Назви змінних та функцій тільки на латиниці.
                <strong>C++<strong>: назви змінних і функцій не можуть починатися з цифри! Не можна використовувати ключові слова:
                        <table width="100%" border="1">
                            <tbody><tr>
                                <td>asm </td>
                                <td>auto </td>
                                <td>bool </td>
                                <td>break </td>
                                <td>case</td>
                            </tr>
                            <tr>
                                <td>catch </td>
                                <td>char </td>
                                <td>class </td>
                                <td>const </td>
                                <td>const_cast</td>
                            </tr>
                            <tr>
                                <td>continue </td>
                                <td>default </td>
                                <td>delete </td>
                                <td>do </td>
                                <td>double</td>
                            </tr>
                            <tr>
                                <td>dynamic_cast </td>
                                <td>else </td>
                                <td>enum </td>
                                <td>explicit </td>
                                <td>export</td>
                            </tr>
                            <tr>
                                <td>extern </td>
                                <td>false </td>
                                <td>float </td>
                                <td>for </td>
                                <td>friend</td>
                            </tr>
                            <tr>
                                <td>goto </td>
                                <td>goto </td>
                                <td>inline </td>
                                <td>int </td>
                                <td>long</td>
                            </tr>
                            <tr>
                                <td>mutable </td>
                                <td>namespace </td>
                                <td>new </td>
                                <td>operator </td>
                                <td>private</td>
                            </tr>
                            <tr>
                                <td>protected </td>
                                <td>public </td>
                                <td>register </td>
                                <td>reinterpret_cast </td>
                                <td>return</td>
                            </tr>
                            <tr>
                                <td>short </td>
                                <td>signed </td>
                                <td>sizeof </td>
                                <td>static </td>
                                <td>static_cast</td>
                            </tr>
                            <tr>
                                <td>short short </td>
                                <td>signed </td>
                                <td>sizeof </td>
                                <td>static </td>
                                <td>static_cast</td>
                            </tr>
                            <tr>
                                <td>struct </td>
                                <td>switch </td>
                                <td>template </td>
                                <td>this </td>
                                <td>throw</td>
                            </tr>
                            <tr>
                                <td>typedef </td>
                                <td>true </td>
                                <td>try </td>
                                <td>typeid </td>
                                <td>typename</td>
                            </tr>
                            <tr>
                                <td>union </td>
                                <td>voidunion </td>
                                <td>using </td>
                                <td>virtual </td>
                                <td>void</td>
                            </tr>
                            </tbody>
                        </table>
                <strong>Java<strong>: назви змінних і функцій не можуть починатися з цифри! Не можна використовувати ключові слова:
                        <table width="100%" border="1">
                            <tbody><tr>
                                <td>abstract</td>
                                <td>assert</td>
                                <td>boolean</td>
                                <td>break</td>
                            </tr>
                            <tr>
                                <td>byte</td>
                                <td>case</td>
                                <td>catch</td>
                                <td>char</td>
                            </tr>
                            <tr>
                                <td>class</td>
                                <td>const</td>
                                <td>continue</td>
                                <td>default</td>
                            </tr>
                            <tr>
                                <td>do</td>
                                <td>double</td>
                                <td>else</td>
                                <td>enum</td>
                            </tr>
                            <tr>
                                <td>extends</td>
                                <td>final</td>
                                <td>finally</td>
                                <td>float</td>
                            </tr>
                            <tr>
                                <td>for</td>
                                <td>goto</td>
                                <td>if</td>
                                <td>implements</td>
                            </tr>
                            <tr>
                                <td>import</td>
                                <td>instanceof</td>
                                <td>int</td>
                                <td>interface</td>
                            </tr>
                            <tr>
                                <td>long</td>
                                <td>native</td>
                                <td>new</td>
                                <td>package</td>
                            </tr>
                            <tr>
                                <td>private</td>
                                <td>protected</td>
                                <td>public</td>
                                <td>return</td>
                            </tr>
                            <tr>
                                <td>short</td>
                                <td>static</td>
                                <td>strictfp</td>
                                <td>super</td>
                            </tr>
                            <tr>
                                <td>switch</td>
                                <td>synchronized</td>
                                <td>this</td>
                                <td>throw</td>
                            </tr>
                            <tr>
                                <td>throws</td>
                                <td>transient</td>
                                <td>try</td>
                                <td>void</td>
                            </tr>
                            <tr>
                                <td>volatile</td>
                                <td>while</td><td>
                                </td><td></td>
                            </tr>
                            </tbody>
                        </table>
                <strong>JavaScript<strong>: назви змінних і функцій не можуть починатися з цифри! Не можна використовувати ключові слова:
                        <table width="100%" border="1">
                            <tbody><tr>
                                <td>abstract</td>
                                <td>arguments</td>
                                <td>boolean</td>
                                <td>break</td>
                                <td>byte</td>
                            </tr>
                            <tr>
                                <td>case</td>
                                <td>catch</td>
                                <td>char</td>
                                <td>class*</td>
                                <td>const</td>
                            </tr>
                            <tr>
                                <td>continue</td>
                                <td>debugger</td>
                                <td>default</td>
                                <td>delete</td>
                                <td>do</td>
                            </tr>
                            <tr>
                                <td>double</td>
                                <td>else</td>
                                <td>enum*</td>
                                <td>eval</td>
                                <td>export*</td>
                            </tr>
                            <tr>
                                <td>extends*</td>
                                <td>false</td>
                                <td>final</td>
                                <td>finally</td>
                                <td>float</td>
                            </tr>
                            <tr>
                                <td>for</td>
                                <td>function</td>
                                <td>goto</td>
                                <td>if</td>
                                <td>implements</td>
                            </tr>
                            <tr>
                                <td>import*</td>
                                <td>in</td>
                                <td>instanceof</td>
                                <td>int</td>
                                <td>interface</td>
                            </tr>
                            <tr>
                                <td>let</td>
                                <td>long</td>
                                <td>native</td>
                                <td>new</td>
                                <td>null</td>
                            </tr>
                            <tr>
                                <td>package</td>
                                <td>private</td>
                                <td>protected</td>
                                <td>public</td>
                                <td>return</td>
                            </tr>
                            <tr>
                                <td>short</td>
                                <td>static</td>
                                <td>super*</td>
                                <td>switch</td>
                                <td>synchronized</td>
                            </tr>
                            <tr>
                                <td>this</td>
                                <td>throw</td>
                                <td>throws</td>
                                <td>transient</td>
                                <td>true</td>
                            </tr>
                            <tr>
                                <td>try</td>
                                <td>typeof</td>
                                <td>var</td>
                                <td>void</td>
                                <td>volatile</td>
                            </tr>
                            <tr>
                                <td>while</td>
                                <td>with</td>
                                <td>yield</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                <strong>C#<strong>: назви змінних і функцій не можуть починатися з цифри! Не можна використовувати ключові слова:
                        <table width="100%" border="1">
                            <tbody>
                            <tr>
                                <td>&nbsp;abstract</td>
                                <td>&nbsp;add</td>
                                <td>&nbsp;as</td>
                                <td>&nbsp;ascending</td>
                            </tr>
                            <tr>
                                <td>&nbsp;async</td>
                                <td>&nbsp;await</td>
                                <td>&nbsp;base</td>
                                <td>&nbsp;bool</td>
                            </tr>
                            <tr>
                                <td>&nbsp;break</td>
                                <td>&nbsp;by</td>
                                <td>&nbsp;byte</td>
                                <td>&nbsp;case</td>
                            </tr>
                            <tr>
                                <td>&nbsp;catch</td>
                                <td>&nbsp;char</td>
                                <td>&nbsp;checked</td>
                                <td>&nbsp;class</td>
                            </tr>
                            <tr>
                                <td>&nbsp;const</td>
                                <td>&nbsp;continue</td>
                                <td>&nbsp;decimal</td>
                                <td>&nbsp;default</td>
                            </tr>
                            <tr>
                                <td>&nbsp;delegate</td>
                                <td>&nbsp;descending</td>
                                <td>&nbsp;do</td>
                                <td>&nbsp;double</td>
                            </tr>
                            <tr>
                                <td>&nbsp;dynamic</td>
                                <td>&nbsp;else</td>
                                <td>&nbsp;enum</td>
                                <td>&nbsp;equals</td>
                            </tr>
                            <tr>
                                <td>&nbsp;explicit</td>
                                <td>&nbsp;extern</td>
                                <td>&nbsp;false</td>
                                <td>&nbsp;finally</td>
                            </tr>
                            <tr>
                                <td>&nbsp;fixed</td>
                                <td>&nbsp;float</td>
                                <td>&nbsp;for</td>
                                <td>&nbsp;foreach</td>
                            </tr>
                            <tr>
                                <td>&nbsp;from</td>
                                <td>&nbsp;get</td>
                                <td>&nbsp;global</td>
                                <td>goto</td>
                            </tr>
                            <tr>
                                <td>group</td>
                                <td>&nbsp;if</td>
                                <td>&nbsp;implicit</td>
                                <td>&nbsp;in</td>
                            </tr>
                            <tr>
                                <td>&nbsp;int</td>
                                <td>&nbsp;interface</td>
                                <td>&nbsp;internal</td>
                                <td>&nbsp;into</td>
                            </tr>
                            <tr>
                                <td>&nbsp;is</td>
                                <td>&nbsp;join</td>
                                <td>&nbsp;let</td>
                                <td>&nbsp;lock</td>
                            </tr>
                            <tr>
                                <td>&nbsp;long</td>
                                <td>&nbsp;namespace</td>
                                <td>&nbsp;new</td>
                                <td>&nbsp;null</td>
                            </tr>
                            <tr>
                                <td>&nbsp;object</td>
                                <td>&nbsp;on</td>
                                <td>&nbsp;operator</td>
                                <td>&nbsp;orderby</td>
                            </tr>
                            <tr>
                                <td>&nbsp;out</td>
                                <td>&nbsp;override</td>
                                <td>&nbsp;params</td>
                                <td>&nbsp;partial</td>
                            </tr>
                            <tr>
                                <td>&nbsp;private</td>
                                <td>&nbsp;protected</td>
                                <td>&nbsp;public</td>
                                <td>&nbsp;readonly</td>
                            </tr>
                            <tr>
                                <td>&nbsp;ref</td>
                                <td>&nbsp;remove</td>
                                <td>&nbsp;return</td>
                                <td>&nbsp;sbyte</td>
                            </tr>
                            <tr>
                                <td>&nbsp;sealed</td>
                                <td>&nbsp;select</td>
                                <td>&nbsp;set</td>
                                <td>&nbsp;short</td>
                            </tr>
                            <tr>
                                <td>&nbsp;sizeof</td>
                                <td>&nbsp;stackalloc</td>
                                <td>&nbsp;static</td>
                                <td>&nbsp;string</td>
                            </tr>
                            <tr>
                                <td>&nbsp;struct</td>
                                <td>&nbsp;switch</td>
                                <td>&nbsp;this</td>
                                <td>&nbsp;throw</td>
                            </tr>
                            <tr>
                                <td>&nbsp;true</td>
                                <td>&nbsp;try</td>
                                <td>&nbsp;typeof</td>
                                <td>&nbsp;uint</td>
                            </tr>
                            <tr>
                                <td>&nbsp;ulong</td>
                                <td>&nbsp;unchecked</td>
                                <td>&nbsp;unsafe</td>
                                <td>&nbsp;ushort</td>
                            </tr>
                            <tr>
                                <td>&nbsp;using</td>
                                <td>&nbsp;value</td>
                                <td>&nbsp;var</td>
                                <td>&nbsp;virtual</td>
                            </tr>
                            <tr>
                                <td>&nbsp;void</td>
                                <td>&nbsp;volatile</td>
                                <td>&nbsp;where</td>
                                <td>&nbsp;while</td>
                            </tr>
                            <tr>
                                <td>&nbsp;yield</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                        <strong>PHP</strong><strong>: назви змінних і функцій не можуть починатися з цифри та $(інтерпретатор доставляє сам)! Не можна використовувати ключові слова:
                        <table  width="100%" border="1">
                            <tbody>
                            <tr>
                                <td>__halt_compiler()</td>
                                <td>abstract</td>
                                <td>and</td>
                                <td>array()</td>
                                <td>as</td>
                            </tr>
                            <tr>
                                <td>break</td>
                                <td>callable</td>
                                <td>case</td>
                                <td>catch</td>
                                <td>class</td>
                            </tr>
                            <tr>
                                <td>clone</td>
                                <td>const</td>
                                <td>continue</td>
                                <td>declare</td>
                                <td>default</td>
                            </tr>
                            <tr>
                                <td>die()</td>
                                <td>do</td>
                                <td>echo</td>
                                <td>else</td>
                                <td>elseif</td>
                            </tr>
                            <tr>
                                <td>empty()</td>
                                <td>enddeclare</td>
                                <td>endfor</td>
                                <td>endforeach</td>
                                <td>endif</td>
                            </tr>
                            <tr>
                                <td>endswitch</td>
                                <td>endwhile</td>
                                <td>eval()</td>
                                <td>exit()</td>
                                <td>extends</td>
                            </tr>
                            <tr>
                                <td>final</td>
                                <td>finally</td>
                                <td>for</td>
                                <td>foreach</td>
                                <td>function</td>
                            </tr>
                            <tr>
                                <td>global</td>
                                <td>goto</td>
                                <td>if</td>
                                <td>implements</td>
                                <td>include</td>
                            </tr>
                            <tr>
                                <td>include_once</td>
                                <td>instanceof</td>
                                <td>insteadof</td>
                                <td>interface</td>
                                <td>isset()</td>
                            </tr>
                            <tr>
                                <td>list()</td>
                                <td>namespace</td>
                                <td>new</td>
                                <td>or</td>
                                <td>print</td>
                            </tr>
                            <tr>
                                <td>private</td>
                                <td>protected</td>
                                <td>public</td>
                                <td>require</td>
                                <td>require_once</td>
                            </tr>
                            <tr>
                                <td>return</td>
                                <td>static</td>
                                <td>switch</td>
                                <td>throw</td>
                                <td>trait</td>
                            </tr>
                            <tr>
                                <td>try</td>
                                <td>unset()</td>
                                <td>use</td>
                                <td>var</td>
                                <td>while</td>
                            </tr>
                            <tr>
                                <td>xor</td>
                                <td>yield</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
            </pre>
        </div>
        <div class="container">
            <div class="row col header">
                <div>Назва функції</div>
                <input class="form-control functionName" maxlength="32" ng-pattern="/^[a-zA-Z_][0-9a-zA-Z_]?[^\s]*$/" placeholder="Назва функції" ng-model="finalResult.name" required ng-change="fNameGenerate()"/>
                <input class="form-control functionPrefix" disabled ng-model="prefix" />
                <input class="form-control langTask" disabled ng-model="lang" />
            </div>
        </div>
        <h2 id="title">Параметри функції</h2>
        <div class="container">
            <div class="row col" id="params">
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
        <div class="row">
            <div class="container">
                <button ng-click="addDellFormResult(0)" type="button" class="btn btn-default pull-right btnInterp" title="Додати юніттест">
                    <span class="glyphicon-plus glyphicon glyphicon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
        <div class="container">
            <h2 id="title">Еталонний код</h2>
            <div class="row col header">
                Еталон(не обов'язкове поле, якщо вказані result value в кожному юніт-тесті)
                <ui-codemirror ui-codemirror-opts="codeMirrorOptions" ng-model="finalResult.etalon" ></ui-codemirror>
            </div>
        </div>
        <h2 id="title">Результат</h2>
        <div>
            <result-form/>
        </div>
        <img style="display: none" id="ajaxLoad" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'ajax.gif'); ?>" />
        <label>Показати JSON: <input type="checkbox" ng-model="checked" ng-init="checked=false" /></label><br/>
        <div ng-if="checked">
            <pre>{{res_finalResult | json}}</pre>
        </div>
    </form>
</div>
