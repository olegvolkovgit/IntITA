<div class="form-group">
    <label for="input-select-node">Пошук ревізії:</label>
    <input type="input" class="form-control" id="input-select-node" placeholder="Ідентифікатор ревізії">
</div>
<div class="form-group">
    <input type="button" class="btn btn-secondary" value="Очистити пошук" ng-click="clearSearch()">
    <input type="button" class="btn btn-secondary" value="Згорнути дерево" ng-click="collapseAll()">
    <input type="button" class="btn btn-secondary" value="Розгорнути дерево" ng-click="expandAll()">
    <input type="button" class="btn btn-secondary" value="Оновити дерево" ng-click="updateTree()">
    <div ng-show="approvedTree" style="display: inline-block">
        <label>
            <input type="radio" ng-checked=true ng-model="approvedRevisions" ng-change="loadTreeMode()" id="allTree" value="false">
            Всі ревізії
        </label>
        <label>
            <input type="radio" ng-model="approvedRevisions" ng-change="loadTreeMode()" id="approvedTree" value="true">
            Ревізії в релізі
        </label>
    </div>
</div>
<div id="tree">
</div>