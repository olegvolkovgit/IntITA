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

    var lBl = document.getElementsByClassName("labelBlock");
    for (var i = 0; i < lBl.length; i++) {
        lBl[i].onclick = getIdName;
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
                imageUpload: '/lesson/uploadImage',
                plugins: ['table',
                          'fontfamily',
                          'fontsize',
                          'fontcolor',
                          'video',
                          'imagemanager',
                          'fullscreen',
                          'save',
                          'close'],
                formattingAdd: [
                    {
                        tag: 'pre',
                        title: 'Code php',
                        class: 'brush:php'
                    },
                    {
                        tag: 'pre',
                        title: 'Code js',
                        class: 'brush:js'
                    },
                    {
                        tag: 'pre',
                        title: 'Code css',
                        class: 'brush:css'
                    },
                    {
                        tag: 'pre',
                        title: 'Code sql',
                        class: 'brush:sql'
                    },
                    {
                        tag: 'pre',
                        title: 'Code html',
                        class: 'brush:html'
                    },
                    {
                        tag: 'pre',
                        title: 'Code C++',
                        class: 'brush:c'
                    },
                    {
                        tag: 'pre',
                        title: 'Code C#',
                        class: 'brush:c#'
                    },
                    {
                        title: 'Clear Format',
                        func: 'inline.removeFormat'
                    }],
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

