<div class="tab-content" ng-controller="writtenAgreementTemplate">
    <div class="tab-pane fade in active" id="offer">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row" style="padding:5px">
                    <ul class="list-inline" style="text-align: right">
                        <li>
                            <button class="btn btn-primary" ng-click="saveAgreementTemplate(agreementTemplate)">Створити шаблон договору</button>
                        </li>
                    </ul>
                    <label>
                        <strong>Назва шаблону:</strong>
                    </label>
                    <input type="text" size="135" ng-model="agreementTemplate.name" placeholder="Назва" class="form-control" />
                    <br>
                    <textarea id="CKE" ng-cloak ckeditor="editorOptionsAgreement" name="html_block" ng-model="agreementTemplate.template" required></textarea>
                    <h2 style="text-align: center">Попередній перегляд</h2>
                    <div class="offer" style="background:#f9f9f9; padding: 10px">
                        <div compile="agreementTemplate.template"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', '/_teacher/writtenAgreement.css'); ?>"/>