<?php
/**
 * @var $record Lecture
 */
?>
<div class="col-lg-12" ng-controller="verifyContentCtrl">
    <button class="btn btn-primary"
            ng-click="reindexContent('<?php echo Yii::app()->createUrl("/_teacher/_admin/verifyContent/initializeDir") ?>')">
        Переіндексація контенту
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            Лекції
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#wait" data-toggle="tab">Заняття очікують шаблонізації</a>
                </li>
                <li><a href="#verified" data-toggle="tab">Шаблонізовані заняття</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="wait">
                    <?php $this->renderPartial('_waitVerify', array(), false, true);?>
                </div>
                <div class="tab-pane fade" id="verified">
                    <?php $this->renderPartial('_verified', array(), false, true);?>
                </div>
            </div>
        </div>
    </div>

</div>
</div>




