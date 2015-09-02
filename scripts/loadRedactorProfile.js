
window.onload = function () {
    var tBl = document.getElementsByClassName("editableText");
    for (var i = 0; i < tBl.length; i++) {
        tBl[i].onclick = getIdName;
    }

    function getIdName() {
        var idName = this.getAttribute('id');
        order = '#'+ idName;
        block = idName;

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
                'close',
                'closefullscreen'],
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

