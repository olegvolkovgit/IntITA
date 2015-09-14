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
        iBl[i].onclick = getTaskIdName;
    }

    var lBl = document.getElementsByClassName("labelBlock");
    for (var i = 0; i < lBl.length; i++) {
        lBl[i].onclick = getIdName;
    }
    var testBl = document.getElementsByClassName("instrTestText");
    for (var i = 0; i < testBl.length; i++) {
        testBl[i].onclick = getTestIdName;
    }
    var instBl = document.getElementsByClassName("instructionText");
    for (var i = 0; i < instBl.length; i++) {
        instBl[i].onclick = getIdName;
    }
    /*���� ���������� �� ����� ��� ����������� ��� ���� �� ������� ����� ���� �����������(������� �������) ����� ����������� �����*/
    function getTestIdName() {
        var idName = this.getAttribute('id');
        order = '#'+ idName;

        var edit = this.hasAttribute("contenteditable");
        if(edit == false){
            $('#'+ idName).closest(".element").hide();
            var content=$('#'+ idName).closest(".element").next('.editTest')
            content.show();
        }
    }
    /*���� ���������� �� ����� ��� ����������� ��� ���� �� ������� ����� ���� �����������(������� �������) ����� ����������� �����*/
    function getTaskIdName() {
        var idName = this.getAttribute('id');
        order = '#'+ idName;

        var edit = this.hasAttribute("contenteditable");
        if(edit == false){
            $('#'+ idName).closest(".element").hide();
            var content=$('#'+ idName).closest(".element").next('.editTask');
            content.show();
        }
    }

function getIdName() {
    var idName = this.getAttribute('id');
    order = '#'+ idName;

    var edit = this.hasAttribute("contenteditable");
    if(edit == false){
        loadTextRedactor();
        $(order).attr('data-target','insertE');
        if($("div").is("#toolbar"+idName)){
            $(order).parent().next('#toolbar'+idName).after('<div class="container" id="formulaBox">'+
                '<div class="inner">'+
                '<textarea placeholder="Формула для вставки в блок" class="source" data-source="insertE" id="formulaContainer'+idName+'"></textarea>'+
                '<label><input id="inlineFormulaE" type="checkbox" checked/>Формула в тексті</label>'+
                '</div>'+
                '<div style="font-size: 12px">Поставте курсор в текстовий блок та вставте LaTeX формулу</div>'+
                '<button type="button" class="action" onclick="insertFormulaE()">Вставити формулу</button>'+
                '</div>'
            );
            $('#toolbar'+idName).show();
            var id = "toolbar" + idName;
            EqEditor.embed(id, '', 'full', 'uk-uk');
            var a = new EqTextArea('equation', 'formulaContainer'+idName);
            EqEditor.add(a, false);
            document.getElementById('formulaContainer'+idName).focus();
        }else{
            $(order).parent().after('<div class="container" id="formulaBox">'+
                '<div class="inner">'+
                '<textarea placeholder="Формула для вставки в блок" class="source" data-source="insertE" id="formulaContainer'+idName+'"></textarea>'+
                '<label><input id="inlineFormulaE" type="checkbox" checked/>Формула в тексті</label>'+
                '</div>'+
                '<div style="font-size: 12px">Поставте курсор в текстовий блок та вставте LaTeX формулу</div>'+
                '<button type="button" class="action" onclick="insertFormulaE()">Вставити формулу</button>'+
                '</div>'
            );
            var id = "toolbar" + idName;
            $(order).parent().after('<div id="toolbar'+idName+'" style="display: block"></div>');
            EqEditor.embed(id, '', 'full', 'uk-uk');
            var a = new EqTextArea('equation', 'formulaContainer'+idName);
            EqEditor.add(a, false);
            document.getElementById('formulaContainer'+idName).focus();
        }
    }
}
        function loadTextRedactor()
        {
            orderBlock=order.replace("#t","");
            $.ajax({
                type: "POST",
                url: "/lesson/editBlock",
                data: {'order':orderBlock, 'lecture':idLecture},
                success: function(result){
                    $(order).html(result);
                }
            });
            $(order).redactor({
                preSpaces: true,
                cleanStyleOnEnter: false,
                replaceDivs: false,
                lang:lang,
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
                          'formula',
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
                    $('#formulaBox').remove();
                    console.log('destroy');
                    $(order).on('click', loadTextRedactor);
                }
            });
        }
}


function insertFormulaE(){
    var $content = $('[data-target="insertE"]'),
        $source = $('[data-source="insertE"]');

        $content.trigger('focus');
        insertHTMLE($source.val());
}

function insertHTMLE(html) {
    try {
        $('[data-target="insertE"]').focus();
        if($("#inlineFormulaE").prop("checked")){
            html = '\\(' + html;
            html = html + '\\)';
        } else {
            html = '\\[' + html;
            html = html + '\\]';
        }
        var selection = window.getSelection(),
            range = selection.getRangeAt(0),
            temp = document.createElement('div'),
            insertion = document.createDocumentFragment();

        temp.innerHTML = html;

        while (temp.firstChild) {
            insertion.appendChild(temp.firstChild);
        }

        range.deleteContents();
        range.insertNode(insertion);
        $('[data-target="insertE"]').next('textarea').val($('[data-target="insertE"]').html());
    } catch (z) {
        try {
            document.selection.createRange().pasteHTML(html);
        } catch (z) {}
    }
}
