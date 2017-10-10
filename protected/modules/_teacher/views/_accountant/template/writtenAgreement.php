<div class="tab-content" ng-controller="agreementTemplate">
    <div class="tab-pane fade in active" id="offer">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row" style="padding:5px">
                    <ul class="list-inline">
                        <li>
                            <a type="button" class="btn btn-primary" ng-href="#/accountant/updateWrittenAgreement">
                                Редагувати шаблон договору
                            </a>
                        </li>
                    </ul>
                    <h2 style="text-align: center">Приклад з данними</h2>
                    <div class="offer" style="background:#f9f9f9; padding: 10px">
                        <div compile="agreementTemplate"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
