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
            success: function(response){  $('div[name="selectInvoices"]').html(response); }
        });
    }

function getAgreementsList(){
    number = "";
    user = "";
    course = "";
    module = "";
    var radio = document.getElementsByName('find');

    for(var j = 0 ;j < radio.length; j++)
    {
        if(radio[j].checked)
        {
            switch (j)
            {
                case 0 : number = $("#numberCriteriaValue option:selected").val();
                    break;
                case 1 : user = $('#userCriteriaValue option:selected').val() ;
                    break;
                case  2 : course = $('#courseCriteriaValue option:selected').val();
                    break;
                case 3 : module = $('#moduleCriteriaValue option:selected').val();
                    break;
            }
            break;

        }
    }

    $.ajax({
        type: "POST",
        url: "../getSearchAgreements",
        data: {
            'number': number,
            'user': user,
            'course': course,
            'module': module
        },
        cache: false,
        success: function(response)
        {
            $('div[name="selectAgreement"]').html(response);
        }
    });
}

function showList(id)
{
    var list = document.getElementsByName('find');

    for(var i = 1; i < list.length + 1; i++)
    {
        if(id == i)
        {
            document.getElementById(id).style.display = 'inline-block';
        }
        else {
            document.getElementById(i).style.display = 'none';
        }

    }
}

function showOperation(id)
{
    var offer = document.getElementById('findOffer');
    var operation = document.getElementById('findOperation');

    switch(id)
    {
        case 1 : offer.style.display = 'block';
            operation.style.display = 'none';
            break;
        case 2 : operation.style.display = 'block';
            offer.style.display = 'none';
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