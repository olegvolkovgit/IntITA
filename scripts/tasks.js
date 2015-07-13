/**
 * Created by Ivanna on 13.07.2015.
 */
function createTask(){
    document.getElementById('addTask').style.display = 'none';
    header = document.getElementById('header').value;
    etalon = document.getElementById('etalon').value;
    taskFooter = document.getElementById('taskFooter').value;
    lang = document.getElementById('lang').value;
    name = document.getElementById('name').value;
    var newTask = {
        //            "task": 15,
            "operation": "addtask",
            "name": name,
            "header": header,
            "etalon": etalon,
            "footer": taskFooter,
            "lang": "c++"
    };
    var jqxhr = $.post( "http://ii.itatests.com", JSON.stringify(newTask),function() {
        alert( "success" );
    })
        .done(function(data) {
            alert( data.result );
        })
        .fail(function() {
            alert( "Error" );
        })
        .always(function() {
            //alert( "finished" );
        });
    document.getElementById('addTask').style.display = 'none';
}

