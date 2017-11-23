<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 09.06.2017
 * Time: 12:36
 */
?>
<div class="formMargin">

    <form id="graduateForm" ng-submit="addReview()" novalidate>
        <div class="form-group">
            <label>
                <strong>Назва проекту:</strong>
            </label>
            <input id="position" type="text" class="form-control" name="title"
                   size="90" required ng-model="project.title">
            <div class="error" ng-show="errors.title">{{errors.title}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Репозирорій:</strong>
            </label>
            <input id="position" type="text" class="form-control" name="repo"
                   size="90" required ng-model="project.repo">
            <div class="error" ng-show="errors.repo">{{errors.repo}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Гілка в репозиторії</strong>
            </label>
            <input id="position" type="url" class="form-control" name="branch"
                   size="90" required ng-model="project.branch">
            <div class="error" ng-show="errors.branch">{{errors.branch}}</div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Створити</button>
        </div>
    </form><!-- form -->
</div>