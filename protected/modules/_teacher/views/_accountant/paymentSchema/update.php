<?php
/* @var $scenario
 * $var $canEdit
 */
?>

<div class="panel-body" ng-controller="paymentsSchemaTemplateCtrl">
    <div class="row">
        <fieldset ng-disabled="<?php echo !$canEdit ?>" >
            <div class="formMargin" >
                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Назва шаблону схеми ua*</label>
                        <input name="name_ua" class="form-control" ng-model="template.name_ua" required maxlength="64" size="50">
                        <label>Назва шаблону схеми ru</label>
                        <input name="name_ru" class="form-control" ng-model="template.name_ru" maxlength="64" size="50">
                        <label>Назва шаблону схеми en</label>
                        <input name="name_en" class="form-control" ng-model="template.name_en" maxlength="64" size="50">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Опис, умови, перелік документів (ua)</label>
                        <textarea name="description_ua" class="form-control" ng-model="template.description_ua" style="resize:none"></textarea>
                        <label>Опис, умови, перелік документів (ru)</label>
                        <textarea name="description_ru" class="form-control" ng-model="template.description_ru" style="resize:none"></textarea>
                        <label>Опис, умови, перелік документів (en)</label>
                        <textarea name="description_en" class="form-control" ng-model="template.description_en" style="resize:none"></textarea>
                    </div>
                    *Опис буде відображатися для користувачів, якщо шаблон встановлений як акційна схема проплат
                    (умови застосування схем; перелік документів, потрібних для активації даних схем і т.д.)
                </div>
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>id схеми</th>
                            <th>Кількість проплат</th>
                            <th>Назва схеми</th>
                            <th>Відсоток знижки</th>
                            <th>Відсоток кредиту</th>
                            <th>З паперовим договором</th>
                            <th>
                                Додати схему
                                <button type="button" class="btn btn-default btn-sm" ng-click="operation.addScheme()">
                                    <span class="glyphicon glyphicon-plus-sign"></span>
                                </button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="scheme in schemes track by $index">
                            <td>
                                {{schemes[$index].id}}
                            </td>
                            <td>
                                <select
                                    class="form-control"
                                    ng-model="schemes[$index].pay_count"
                                    ng-options="pay_count.value as pay_count.value for pay_count in payCount"
                                    ng-change="updateScheme(schemes[$index].pay_count,$index)" >
                                </select>
                            </td>
                            <td>
                                <input type="text" ng-disabled=true class="form-control" ng-value="schemes[$index].name">
                            </td>
                            <td>
                                <input type="number" class="form-control" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/"
                                       step="0.01" ng-model="schemes[$index].discount" min="0" max="100"/>
                            </td>
                            <td>
                                <input type="number" class="form-control" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/"
                                       step="0.01" ng-model="schemes[$index].loan" min="0" max="100"/>
                            </td>
                            <td>
                                <input type="checkbox" class="form-control" ng-model="schemes[$index].contract"/>
                            </td>
                            <td ng-if="$index!=0">
                                <button type="button" class="btn btn-default btn-sm" ng-click="operation.removeScheme($index)">
                                    <span class="glyphicon glyphicon-minus-sign"></span>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" ng-click="updateTemplate(template)" ng-disabled="!template.name_ua || !template.schemes.length">
                        Зберегти
                    </button>
                </div>
            </div>
        </fieldset>
        <a type="button" class="btn btn-default" ng-click='back()'>
            Назад
        </a>
    </div>
</div>