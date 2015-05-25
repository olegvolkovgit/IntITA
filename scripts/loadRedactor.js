/**
 * Created by Andrii N. on 12.05.2015.
 */

window.onload = function () {
    var tBl = document.getElementsByClassName("text");
    for (var i = 0; i < tBl.length; i++) {
        tBl[i].onclick = getIdName;
    }

    var cBl = document.getElementsByClassName("code");
    for (var i = 0; i < cBl.length; i++) {
        cBl[i].onclick = getIdName;
    }

    var vBl = document.getElementsByClassName("video");
    for (var i = 0; i < vBl.length; i++) {
        vBl[i].onclick = getIdName;
    }

    var ceBl = document.getElementsByClassName("codeExample");
    for (var i = 0; i < ceBl.length; i++) {
        ceBl[i].onclick = getIdName;
    }

    var iBl = document.getElementsByClassName("instrTaskText");
    for (var i = 0; i < iBl.length; i++) {
        iBl[i].onclick = getIdName;
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
                preSpaces: true,
                cleanStyleOnEnter: false,
                replaceDivs: false,
                autoclear: false,
                pastePlainText: false,
                convertVideoLinks: true,
                convertImageLinks: true,
                convertUrlLinks: true,
                convertLinks: true,
                plugins: ['fontfamily',
                          'fontsize',
                          'fontcolor',
                          'video',
                          'fullscreen',
                          'save',
                          'close'],
                startCallback: function()
                {

                    var marker = this.selection.getMarker();
                    //this.insert.node(marker);
                },
                initCallback: function()
                {
                    //this.selection.restore();
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

