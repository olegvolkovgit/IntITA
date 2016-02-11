/**
 * Created by Quicks on 21.11.2015.
 */
    function getInvoicesList(url){
        var user = document.getElementById('findUser');
        var divClass = user.classList;
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
        $jq.ajax({
            type: "POST",
            url: url,
            data: {
                'id': agreementId
            },
            cache: false,
            success: function(response) {
                if(divClass == 'findOperation tab-pane fade'){
                    document.getElementById('selectInvoices').style.display = 'block';
                    document.getElementById('selectUserInvoices').style.display = 'none';
                    $jq('div[name="selectInvoices"]').html(response);
                }
                else {
                    document.getElementById('selectUserInvoices').style.display = 'block';
                    $jq('div[name="selectUserInvoices"]').html(response);
                }
            }
        });
    }

function getAgreementsList(url){
    var agreement = document.getElementById('agreementNumber').value;
    document.getElementById('selectInvoices').style.display = 'none';
    if(agreement[2] != undefined)
    {
        $jq.ajax({
            type: "POST",
            url: url,
            data: {
                'agreement': agreement
            },
            cache: false,
            success: function(response)
            {
                if(response)
                $jq('div[name="selectAgreement"]').html(response);
                else showDialog('По Вашому запиту нічого не знайдено');
            }
        });
    }
}

function checkInvoices(){
    var list = document.getElementsByName('invoices[]');
        for(var i = 0; i < list.length; i++)
        {
            if(list[i].checked)
                return true;
        }
    showDialog("Виберіть хоча б один рахунок");
    return false;
}

function getInvoicesListByNumber(url){
    var number = document.getElementById('invoiceNumber').value;
    if(number[2] != undefined)
    {
        $jq.ajax({
            type: "POST",
            url: url,
            data: {
                'invoiceNumber': number
            },
            cache: false,
            success: function(response)
            {
                if(response)
                $jq('div[name="selectInvoicesByNumber"]').html(response);
                else showDialog('По Вашому запиту нічого не знайдено');
            }
        });
    }
}

function getAgreementsListByUser(url){
    document.getElementById('selectUserInvoices').style.display = 'none';
    document.getElementById('userAgreement').style.display = 'none';

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

    $jq.ajax({
        type: "POST",
        url: url,
        data: {
            'userId': userId
        },
        cache: false,
        success: function(response){
            document.getElementById('userAgreement').style.display = 'block';
            $jq('div[name="userAgreement"]').html(response); }
    });
}

function getUserList(url){
    var number = document.getElementById('userEmail').value;
    if(number[2] != undefined)
    {
        $jq.ajax({
            type: "POST",
            url: url,
            data: {
                'userEmail': number
            },
            cache: false,
            success: function(response)
            {
                if(response)
                    $jq('div[name="userList"]').html(response);
                else
                    showDialog('По Вашому запиту нічого не знайдено');
            }
        });
    }
}



