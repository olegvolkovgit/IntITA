<?php
/* @var $this ResponseController */
/* @var $model Response */
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/jquery.wysibb.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/theme/default/wbbtheme.css'); ?>" type="text/css" />
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/lang/ua.js'); ?>"></script>
<div  ng-controller="responseModelCtrl" ng-cloak>
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/response">
                Відгуки про викладачів
            </a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/response/detail/{{response.id}}">
                Переглянути відгук
            </a>
        </li>
    </ul>

    <div class="page-header">
        <h4>Редагувати відгук #{{response.id}}</h4>
    </div>

    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-8">
                <form id="response-form" name="responseForm" ng-submit="updateResponse(response.id)" >
                    <div class="form-group">
                        <label>Відгук*</label>
                        <textarea class="editor" id="response" name="responseText" >{{response.bbcode}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Перевірено модератором</label>
                        <select class="form-control" name="Response[is_checked]" id="Response_is_checked">
                            <option value="1" ng-selected="response.is_checked==1">публікувати</option>
                            <option value="0" ng-selected="response.is_checked==0">приховати</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--<!-- Підключення BBCode WysiBB -->

<script>
    $jq(document).ready(function() {
        var wbbOpt = {
            lang: "ua",
            buttons: "bold,italic,underline,|,code,bullist,numlist"
        };
        $jq("#response").wysibb(wbbOpt);
    });
</script>

<!-- Підключення BBCode WysiBB -->
