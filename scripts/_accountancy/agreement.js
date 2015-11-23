/**
 * Created by Quicks on 21.11.2015.
 */
    function getInvoicesList()
    {
        var agreement = document.getElementsByName('agreement');
        var agreementId = '';
        for(var j = 0 ;j < agreement.length; j++)
        {
            if(agreement[j].checked)
            {
               agreementId  = agreement[j].value;
                break;
            }
        }
        $.ajax({
            type: "POST",
            url: "../getInvoicesList",
            data: {
                'id': agreementId
            },
            cache: false,
            success: function(response){
                document.getElementById('selectInvoices').style.display = 'block';
                $('div[name="selectInvoices"]').html(response); }
        });
    }

function getAgreementsList(){

    var agreement = document.getElementById('agreementNumber').value;
    document.getElementById('selectInvoices').style.display = 'none';
    if(agreement[2] != undefined)
    {
        $.ajax({
            type: "POST",
            url: "../getSearchAgreements",
            data: {
                'agreement': agreement
            },
            cache: false,
            success: function(response)
            {
                if(response)
                $('div[name="selectAgreement"]').html(response);

                else
                    alert('По Вашому запиту нічого не знайдено');
            }
        });
    }
}

function showOperation(id)
{
    var offer = document.getElementById('findOffer');
    var operation = document.getElementById('findOperation');
    var user = document.getElementById('findUser');

    switch(id)
    {
        case 1 :
            offer.style.display = 'block';
            operation.style.display = 'none';
            user.style.display = 'none';
            break;
        case 2 : operation.style.display = 'block';
            offer.style.display = 'none';
            user.style.display = 'none';
            break;
        case 3 :
            offer.style.display = 'none';
            operation.style.display = 'none';
            user.style.display = 'block';
            break;
    }
}

function checkInvoices()
{
    var list = document.getElementsByName('invoices[]');
        for(var i = 0; i < list.length; i++)
        {
            if(list[i].checked)
                return true;
        }
    alert("Виберіть хоча б один рахунок");
    return false;
}

function getInvoicesListByNumber()
{
    var number = document.getElementById('invoiceNumber').value;
    if(number[2] != undefined)
    {
        $.ajax({
            type: "POST",
            url: "../getInvoicesByNumber",
            data: {
                'invoiceNumber': number
            },
            cache: false,
            success: function(response)
            {
                if(response)
                $('div[name="selectInvoicesByNumber"]').html(response);

                else
                    alert('По Вашому запиту нічого не знайдено');
            }
        });
    }
}

function getAgreementsListByUser()
{
    var user = document.getElementsByName('user');
    var userId = '';
    for(var j = 0 ;j < user.length; j++)
    {
        if(user[j].checked)
        {
            userId  = user[j].value;
            break;
        }
    }

    $.ajax({
        type: "POST",
        url: "../getAgreementsByUser",
        data: {
            'userId': userId
        },
        cache: false,
        success: function(response){
            document.getElementById('userAgreement').style.display = 'block';
            $('div[name="userAgreement"]').html(response); }
    });
}

function getUserList()
{
    var number = document.getElementById('userEmail').value;
    if(number[2] != undefined)
    {
        $.ajax({
            type: "POST",
            url: "../getUser",
            data: {
                'userEmail': number
            },
            cache: false,
            success: function(response)
            {
                if(response)
                    $('div[name="userList"]').html(response);

                else
                    alert('По Вашому запиту нічого не знайдено');
            }
        });
    }
}



