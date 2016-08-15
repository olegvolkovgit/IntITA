<div ng-controller="agreementDetailCtrl">
    <h3>Детальна інформація про договір №{{agreementData.number}}</h3>
    <table class="table table-hover table-bordered" style="width:50%">
        <tbody>
        <tr>
            <th>ID договору:</th>
            <td>{{agreementData.id}}</td>
        </tr>
        <tr>
            <th>Номер:</th>
            <td>{{agreementData.number}}</td>
        </tr>
        <tr>
            <th>Service:</th>
            <td>{{agreementData.service_id.description}}</td>
        </tr>
        <tr>
            <th>Дата створення:</th>
            <td>{{agreementData.create_date}}</td>
        </tr>
        <tr>
            <th>Користувач:</th>
            <td>{{agreementData.user.fullName}}</td>
        </tr>
        <tr>
            <th>Сума:</th>
            <td>{{agreementData.summa}}</td>
        </tr>
        <tr>
            <th>Підтверджено користувачем:</th>
            <td>{{agreementData.approval_user.fullName}}</td>
        </tr>
        <tr>
            <th>Дата підтвердження:</th>
            <td>{{agreementData.approval_date}}</td>
        </tr>
        <tr>
            <th>Закрив договір:</th>
            <td>{{agreementData.cancel_user.fullName}}</td>
        </tr>
        <tr>
            <th>Дата відміни:</th>
            <td>{{agreementData.cancel_date}}</td>
        </tr>
        <tr>
            <th>Дата закриття:</th>
            <td>{{agreementData.close_date}}</td>
        </tr>
        <tr>
            <th>Схема оплати:</th>
            <td>{{agreementData.payment_schema.name}}</td>
        </tr>
        <tr>
            <th>Причина закриття:</th>
            <td>{{agreementData.cancel_reason_type}}</td>
        </tr>
        </tbody>
    </table>

    <div ng-include="tableTemplate"></div>
    
</div>