/**
 * Created by Ivanna on 09.05.2015.
 */
/**
 * Created by Ivanna on 04.05.2015.
 */
function hideForm(id, title1, title2, title3){
    $form = document.getElementById(id);
    $form.style.display = 'none';
    document.getElementById(title1).innerHTML = '';
    document.getElementById(title2).innerHTML = '';
    document.getElementById(title3).innerHTML = '';
}

$("a").click(function (){
    var container = $('#moduleForm');
    container.hide();
});





