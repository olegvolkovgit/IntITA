/**
 * Created by Ivanna on 07.05.2015.
 */

window.onload = function () {
    var res = document.getElementsByClassName("text");
    for (var i = 0; i < res.length; i++) {
        res[i].onclick = getIdName;
    }

function getIdName() {
    var idName = this.getAttribute('id');
    order = '#'+ idName;
    var edit = this.hasAttribute("contenteditable");
    if(edit == false){
        loadTextRedactor();
    }
}
        function loadTextRedactor()
        {
            $(order).redactor({
                iframe: true,
                plugins: ['video','advanced'],
                startCallback: function()
                {
                    var marker = this.selection.getMarker();
                    this.insert.node(marker, false);
                },
                initCallback: function()
                {
                    this.selection.restore();
                    $(order).off('click', loadTextRedactor);
                },
                destroyCallback: function()
                {
                    console.log('destroy');
                    $(order).on('click', loadTextRedactor);
                }
            });
        }
}

