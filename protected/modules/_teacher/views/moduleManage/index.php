<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('module/create')">Створити модуль</button>
    </li>
</ul>
<?php echo $this->renderPartial('_modules_table', array()); ?>