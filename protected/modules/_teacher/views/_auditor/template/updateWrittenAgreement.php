<div class="tab-content" ng-controller="updateAgreementTemplate">
    <div class="tab-pane fade in active" id="offer">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row" style="padding:5px">
                    <ul class="list-inline">
                        <li>
                            <a type="button" class="btn btn-primary" ng-href="#/auditor/writtenAgreement">
                                Переглянути шаблон договору
                            </a>
                        </li>
                    </ul>
                    <textarea id="CKE" ng-cloak ckeditor="editorOptionsAgreement" name="html_block" ng-model="agreementTemplate" required></textarea>
                    <h2 style="text-align: center">Приклад з данними</h2>
                    <div class="offer" style="background:#f9f9f9; padding: 10px">
                        <div compile="agreementTemplate"></div>
                    </div>
                    <br>
                    <button class="btn btn-primary" ng-click="saveAgreementTemplate(agreementTemplate)">Зберегти</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    span.cke_button__a_number_label,
    span.cke_button__a_date_label,
    span.cke_button__c_title_label,
    span.cke_button__c_representatives_data_label,
    span.cke_button__a_description_label,
    span.cke_button__a_summa_label,
    span.cke_button__a_invoices_label,
    span.cke_button__u_user_doc_label,
    span.cke_button__u_user_data_address_label,
    span.cke_button__u_name_label,
    span.cke_button__c_edpnou_label,
    span.cke_button__c_bank_name_label,
    span.cke_button__c_bank_code_label,
    span.cke_button__c_legal_address_label,
    span.cke_button__c_contacts_label,
    span.cke_button__c_representatives_position_name_label,
    span.cke_button__c_checking_account_label{
        display: inline-block !important;
    }
    em{
        font-weight: bold;
        border: 1px solid #000;
    }
    td{
        border: 1px solid #000;
    }
</style>
