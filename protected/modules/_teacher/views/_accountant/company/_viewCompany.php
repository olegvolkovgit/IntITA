<?php
/**
 * @var $model CorporateEntity
 */
?>
<div class="row">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/company/index'); ?>',
                        'Компанії')">
                Компанії
            </button>
        </li>
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#main" data-toggle="tab">Головне</a>
            </li>
            <li><a href="#representatives" data-toggle="tab">Представники</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="main">
                <?php $this->renderPartial('_mainTab', array('model' => $model));?>
            </div>
            <div class="tab-pane fade" id="representatives">
                <?php $this->renderPartial('_representativesTab', array('model' => $model));?>
            </div>
        </div>
    </div>
</div>


