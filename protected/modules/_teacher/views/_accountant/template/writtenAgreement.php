<?php
/* @var $scenario */
?>
<div class="tab-content" ng-controller="writtenAgreementTemplate">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/accountant/writtenAgreementsList">
                Список шаблонів
            </a>
        </li>
    </ul>
    <div class="tab-pane fade in active" id="offer">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row" style="padding:5px">
                    <?php if($scenario!='view') {?>
                        <ul class="list-inline" style="text-align: right">
                            <li>
                                <label>Горизонтальний режим: <input type="checkbox" ng-model="horizontalMode"></label>
                            </li>
                            <li>
                                <button class="btn btn-primary" ng-click="saveAgreementTemplate(agreementTemplate,'<?php echo $scenario ?>')">Зберегти шаблон договору</button>
                            </li>
                        </ul>
                    <?php } ?>
                    <label>
                        <strong>Назва шаблону:</strong>
                    </label>
                    <input type="text" size="135" ng-model="agreementTemplate.name" placeholder="Назва" class="form-control" <?php if($scenario=='view') echo 'disabled'?>/>
                    <br>
                    <?php if($scenario!='view') {?>
                        <div ng-class="{'col-md-12' : !horizontalMode, 'col-md-6' : horizontalMode}">
                            <textarea id="CKE" ng-cloak ckeditor="editorOptionsAgreement" name="html_block" ng-model="agreementTemplate.template" required></textarea>
                        </div>
                    <?php } ?>
                    <div ng-class="{'col-md-12' : !horizontalMode, 'col-md-6 margin-top-250-px' : horizontalMode}">
                        <h2 style="text-align: center">Попередній перегляд</h2>
                        <div class="offer" ng-class="{'offer-with-scroll' : horizontalMode}" style="background:#f9f9f9; padding: 10px">
                            <div compile="agreementTemplate.template"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', '/_teacher/writtenAgreement.css'); ?>"/>