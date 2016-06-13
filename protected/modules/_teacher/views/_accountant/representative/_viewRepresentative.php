<?php
/**
 * @var $model CorporateRepresentative
 */
?>
<div class="row">
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/representative/index'); ?>',
                        'Представники')">
                Представники
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
            <li><a href="#companies" data-toggle="tab">Компанії</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="main">
                <?php $this->renderPartial('_mainTab', array('model' => $model));?>
            </div>
            <div class="tab-pane fade" id="companies">
                <?php $this->renderPartial('_companiesTab', array('model' => $model));?>
            </div>
        </div>
    </div>
</div>


