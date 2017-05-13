/**
 * Created by Quicks on 21.11.2015.
 */
function getInvoicesList(url) {
    var user = document.getElementById('findUser');
    var divClass = user.classList;
    var agreement = document.getElementsByName('agreement');
    var agreementId = '';
    for (var j = 0; j < agreement.length; j++) {
        if (agreement[j].checked) {
            agreementId = agreement[j].value;
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
        success: function (response) {
            if (divClass == 'findOperation tab-pane fade') {
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

function confirm(url, id) {
    var posting = $jq.post(url, {id: id});
    posting.done(function (response) {
            if (response == "success") {
                bootbox.alert("Договір " + id + " підтверджений.", refresh);
            }
            else {
                bootbox.alert("Договір " + id + " не підтверджений. Спробуйте повторити " +
                    "операцію пізніше або напишіть на адресу " + adminEmail, refresh);
            }
        })
        .fail(function () {
            bootbox.alert("Договір " + id + " не підтверджений. Спробуйте повторити " +
                "операцію пізніше або напишіть на адресу " + adminEmail, refresh);
        });
}

function cancel(url, id) {
    var posting = $jq.post(url, {id: id});
    posting.done(function (response) {
            bootbox.alert(response, refresh);
        })
        .fail(function () {
            bootbox.alert("Договір " + id + " не скасований. Спробуйте повторити " +
                "операцію пізніше або напишіть на адресу " + adminEmail, refresh);
        });
}

function refresh() {
    load(basePath + '/_teacher/_accountant/agreements/index', 'Список договорів');
}

