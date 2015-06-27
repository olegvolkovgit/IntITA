<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 25.06.2015
 * Time: 15:41
 */
$baseUrl = Yii::app()->request->baseUrl;
$this->breadcrumbs = array(
    'Курс',
    'Модуль',
    'Лекція',
    'Редактор формул',
);
?>
<head>
    <link rel="stylesheet" type="text/css"
          href="http://latex.codecogs.com/css/equation-embed.css" />
    <!--[if lte IE 7]>
    <link rel="stylesheet" href="http://latex.codecogs.com/css/ie6.css" type="text/css"/>
    <![endif]-->
    <script type="text/javascript"
            src="http://latex.codecogs.com/js/eq_config.js" ></script>
    <script type="text/javascript"
            src="http://latex.codecogs.com/js/eq_editor-lite-18.js" ></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('#loadeqneditor').click(function(){
                EqEditor.embed('toolbar','','mini','en-us');
                EqEditor.add(new EqTextArea('equation', 'latexInput'),false);
            });
        });
    </script>
</head>
<body>
<button id="loadeqneditor">Load Equation Editor</button>
<div id="editor"></div>
<textarea id="latexInput"></textarea>
<img id="equation" />




<!---->
<!--<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=default"></script>-->
<!--<link type="text/css" rel="stylesheet" href="--><?php //echo $baseUrl; ?><!--/css/codemirror.css"/>-->
<!--<link type="text/css" rel="stylesheet" href="--><?php //echo $baseUrl; ?><!--/css/formulaRedactor.css"/>-->
<!--<link type="text/css" rel="stylesheet" href="--><?php //echo $baseUrl; ?><!--/css/jquery-ui-1.8.17.custom.css"/>-->
<!--<link type="text/css" rel="stylesheet" href="--><?php //echo $baseUrl; ?><!--/css/MainPage.css"/>-->
<!--<link type="text/css" rel="stylesheet" href="--><?php //echo $baseUrl; ?><!--/css/SetUI.css"/>-->
<!--<link type="text/css" rel="stylesheet" href="--><?php //echo $baseUrl; ?><!--/css/jquery-ui-1.8.17.custom.css"/>-->
<!---->
<!--<script src="--><?php //echo $baseUrl; ?><!--/scripts/codemirror.js" type="text/javascript"></script>-->
<!--<script src="--><?php //echo $baseUrl; ?><!--/scripts/stex.js" type="text/javascript"></script>-->
<!--<script src="--><?php //echo $baseUrl; ?><!--/scripts/jquery-1.7.1.min.js" type="text/javascript"></script>-->
<!--<script src="--><?php //echo $baseUrl; ?><!--/scripts/SetUI.js" type="text/javascript"></script>-->
<!--<script src="--><?php //echo $baseUrl; ?><!--/scripts/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>-->
<!---->
<!--<link type="text/css" rel="stylesheet" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/access.css"/>-->
<!---->
<!--<div id="buttons">-->
<!--    <a href="#">-->
<!--        <div id="sendButton" onclick="saveFormula()">Вставити формулу</div>-->
<!--    </a>-->
<!--    <a href="#">-->
<!--        <div id="cancel" onclick="addTeacherAccess()">Скасувати</div>-->
<!--    </a>-->
<!--</div>-->
<!---->
<!--<script type="text/javascript">-->
<!--    //<![CDATA[-->
<!--    try {-->
<!--        if (!window.CloudFlare) {-->
<!--            var CloudFlare = [{-->
<!--                verbose: 0,-->
<!--                p: 0,-->
<!--                byc: 0,-->
<!--                owlid: "cf",-->
<!--                bag2: 1,-->
<!--                mirage2: 0,-->
<!--                oracle: 0,-->
<!--                paths: {cloudflare: "/cdn-cgi/nexp/dok9v=02fcfa4f56/"},-->
<!--                atok: "c99e5d39a9b40dec962ef46000e388de",-->
<!--                petok: "313f188f0c5822f56a120d3e9e5a903baa073f47-1399018247-1800",-->
<!--                zone: "hostmath.com",-->
<!--                rocket: "0",-->
<!--                apps: {}-->
<!--            }];-->
<!--            CloudFlare.push({"apps": {"ape": "6d5a357dc57e2571ed11362b07f5eb9a"}});-->
<!--            !function (a, b) {-->
<!--                a = document.createElement("script"), b = document.getElementsByTagName("script")[0], a.async = !0, a.src = "//ajax.cloudflare.com/cdn-cgi/nexp/dok9v=b064e16429/cloudflare.min.js", b.parentNode.insertBefore(a, b)-->
<!--            }()-->
<!--        }-->
<!--    } catch (e) {-->
<!--    }-->
<!--    ;-->
<!--    //]]>-->
<!--</script>-->
<!---->
<!--<script type="text/x-mathjax-config">-->
<!-- MathJax.Hub.Config({-->
<!-- extensions: ["tex2jax.js","asciimath2jax.js","toMathML.js"],-->
<!-- "HTML-CSS": {imageFont: null },-->
<!-- showMathMenu: false,-->
<!-- showMathMenuMSIE: false,-->
<!-- TeX: { extensions: ["AMSmath.js","AMSsymbols.js","noUndefined.js"]},-->
<!-- jax: ["input/TeX","input/AsciiMath","output/HTML-CSS"]-->
<!-- });-->
<!---->
<!--</script>-->
<!---->
<!---->
<!--<script type="text/javascript">-->
<!--    $(function () {-->
<!--        var aa = $("#HiddenField1").val();-->
<!--        $("#TextAreaInput").text(aa);-->
<!---->
<!--        $.initSetGlobal("TextAreaInput", "MathOutput", "TextAreaLinkCode", "divURL", "divMathML");-->
<!--        $.iniEmbeded("ShowHideEmbeded", "divEmbed", "selectEquation", "ShowHideURL", "ShowHideMathML");-->
<!--        $("#MyTools").initTool();-->
<!--        $("#MyMath20").initMath();-->
<!--        $("#MyMath3528").initMath3528();-->
<!--        $("#MyMath3545").initMath3545();-->
<!--        $("#MyMathHeigh45").initMathHeigh45();-->
<!--        $("#MyFun4020").initFun();-->
<!--        $("#MyGreek20").initGreek();-->
<!--        $("#MyLogic20").initLogic();-->
<!--        $("#MyArrow20").initArrow();-->
<!--        $("#MySymbol20").initSymbol();-->
<!--        $("#MyColor4020").initColor();-->
<!--        $("#MyFontStyleHeigh20").initFontStyle();-->
<!--        $("#MyFontSizeHeigh20").initFontSize();-->
<!---->
<!---->
<!--        var n = $("#HiddenFieldIsAsc").val();-->
<!--        if (n != "") {-->
<!--            useASCII = false;-->
<!--            $("#MyTools ul li a.Asc").click();-->
<!--        }-->
<!---->
<!--    });-->
<!--</script>-->
<!---->
<!---->
<!--<script type="text/javascript">-->
<!--    $(function () {-->
<!--        $('#tabs').tabs({-->
<!--            // event: "mouseover"-->
<!--        });-->
<!--    });-->
<!--</script>-->
<!--<script type="text/javascript">-->
<!--    $(function () {-->
<!--        $('#HyHome').removeClass().addClass("MainMenuSelected");-->
<!--    });-->
<!--</script>-->
<!--<p></p>-->
<!---->
<!--<form method="post" action="" id="form1">-->
<!--<!--    <div class="aspNetHidden">-->
<!--<!--        <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE"-->
<!--<!--               value="/wEPDwUJMTY2MTYzNTE0ZGSZ8SJ71t3CJhlSsB2C4/ocnvnG47WYz3ENYXWadZkdpg=="/>-->
<!--<!--    </div>-->
<!--<!--    <div class="aspNetHidden">-->
<!--<!--        <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION"-->
<!--<!--               value="/wEdAAOGYbLZajKE/H95elBRFDNzCLGk/TWeF3UL/r/EUZkfQXSaRWlX7GRec/+4JTyOUk6kwwAJc3uQ2kX+nDVmAGNXs7LRnDAGp7K9h2X0GFOmZg=="/>-->
<!--<!--    </div>-->
<!---->
<!--    <div id="container">-->
<!--        <div id="content">-->
<!--<!--            <input type="hidden" name="ctl00$ContentPlaceHolder1$HiddenField1" id="HiddenField1"-->
<!--<!--                   value="\frac{-b\pm\sqrt{b^2-4ac}}{2a}"/>-->
<!--<!--            <input type="hidden" name="ctl00$ContentPlaceHolder1$HiddenFieldIsAsc" id="HiddenFieldIsAsc"/>-->
<!---->
<!--            <table cellpadding="0" cellspacing="0" class="MainTable" border="0">-->
<!--                <tr>-->
<!--                    <td style="width:226px !important;">-->
<!---->
<!--                        <div id="tabs" style="min-width: 226px !important;">-->
<!--                            <ul>-->
<!--                                <li><a href="#tabs-Math">&Sigma;</a></li>-->
<!--                                <li title="Функції"><a href="#tabs-Function">f(&alpha;)</a></li>-->
<!--                                <li title="Логіка"><a href="#tabs-Logic">&ne;</a></li>-->
<!--                                <li title="Масиви"><a href="#tabs-Arrow">(&uArr;)</a></li>-->
<!--                                <li title="Символи"><a href="#tabs-Symbol">&forall;</a></li>-->
<!--                                <li title="Форматування"><a href="#tabs-Format">&hellip;</a></li>-->
<!--                            </ul>-->
<!---->
<!--                            <div id="tabs-Math">-->
<!--                                <div id="MyMath20" class="ForAllNormal"></div>-->
<!--                                <div id="MyMath3528" class="ForAllNormal"></div>-->
<!--                                <div id="MyMath3545" class="ForAllNormal"></div>-->
<!--                                <div id="MyMathHeigh45" class="ForAllNormal"></div>-->
<!---->
<!--                            </div>-->
<!---->
<!---->
<!--                            <div id="tabs-Function">-->
<!--                                <div id="MyGreek20" class="ForAllNormal"></div>-->
<!--                                <div id="MyFun4020" class="ForAllNormal"></div>-->
<!--                            </div>-->
<!---->
<!--                            <div id="tabs-Logic">-->
<!--                                <div id="MyLogic20" class="ForAllNormal"></div>-->
<!--                            </div>-->
<!---->
<!--                            <div id="tabs-Arrow">-->
<!--                                <div id="MyArrow20" class="ForAllNormal"></div>-->
<!--                            </div>-->
<!---->
<!--                            <div id="tabs-Symbol">-->
<!--                                <div id="MySymbol20" class="ForAllNormal"></div>-->
<!--                            </div>-->
<!---->
<!--                            <div id="tabs-Format">-->
<!--                                <div id="MyColor4020" class="ForAllNormal"></div>-->
<!--                                <div id="MyFontStyleHeigh20" class="ForAllNormal"></div>-->
<!--                                <div id="MyFontSizeHeigh20" class="ForAllNormal"></div>-->
<!--                            </div>-->
<!---->
<!---->
<!--                        </div>-->
<!---->
<!---->
<!--                    </td>-->
<!--                    <td width="5px;">-->
<!--                        <div style="min-width:5px !important;"></div>-->
<!--                    </td>-->
<!--                    <td>-->
<!---->
<!--                        <div id="MyTools" style="min-width: 420px !important;">-->
<!--                            <ul style="float:right;margin-right:10px;">-->
<!--                                <li class="separator"></li>-->
<!--                                <li title="РџРѕРєР°Р·Р°С‚СЊ СЃРєСЂРёРїС‚"><a href="javascript:void(0);" id="ShowHideURL"-->
<!--                                                                             style="text-decoration:none;padding-left:4px !important; background: url() no-repeat !important;"></a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!---->
<!---->
<!--                        <textarea id="TextAreaInput"></textarea>-->
<!---->
<!--                        <div id="MathOutput" style="height:165px !important;">-->
<!--                            <div id="ForLatext">\[{}\]</div>-->
<!--                            <div id="ForASC">\({}\)</div>-->
<!--                        </div>-->
<!---->
<!--                        <!--                        <div id="divURL" style="font-size:12px !important;width:100% !important;padding: 0px !important;text-align:center !important;background-color:#FFFFCC !important;"></div>-->
<!--                        <!---->
<!--                        <!---->
<!--                        <!---->
<!--                        <!--                        <div  style="color:#cecece;margin-left:5px;margin-top:3px;font-size:12px;">Для получения кода скрипта - нажмите кнопку "JS" и скопируйте появившийся код вызова скрипта, а затем вставьте на страницу вашего сайта. </div>-->
<!---->
<!--                        <textarea-->
<!--                            style="background-color:#FFFFCC !important;overflow: hidden !important;margin-left: 1px !important;"-->
<!--                            id="TextAreaLinkCode" readonly="readonly"></textarea>-->
<!---->
<!--                    </td>-->
<!--                </tr>-->
<!--            </table>-->
<!--        </div>-->
<!--        <script type="text/javascript">-->
<!--//            function createIframe() {-->
<!--//                var i = document.createElement("iframe");-->
<!--//                i.src = "Vote.htm";-->
<!--//                i.width = "350px;";-->
<!--//                i.height = "30px;";-->
<!--//                i.style.border = "solid 0px #000000";-->
<!--//                i.frameBorder = "no";-->
<!--//                i.scrolling = "no";-->
<!--//                document.getElementById("vote").appendChild(i);-->
<!--//            }-->
<!--//-->
<!--            if (window.addEventListener) window.addEventListener("load", createIframe, false);-->
<!--            else if (window.attachEvent) window.attachEvent("onload", createIframe);-->
<!--            else window.onload = createIframe;-->
<!---->
<!--            function saveFormula() {-->
<!--                formulaCode = document.getElementById("TextAreaLinkCode").innerHTML;-->
<!--                alert(formulaCode);-->
<!--            }-->
<!--        </script>-->
<!--    </div>-->
<!--</form>-->
<!---->
<!---->
<!--<!--<div>-->
<!--<!--    <script type="text/javascript">var script = document.createElement("script");-->
<!--<!--        script.src = "/stat/dspixel.js?ab=uc&cl=" + window.location.href + "&bcn=" + navigator.appCodeName + "&bn=" + navigator.appName + "&bv=" + navigator.appVersion + "&ce=" + navigator.cookieEnabled + "&bl=" + navigator.language + "&np=" + navigator.platform + "&sw=" + screen.width + "&sh=" + screen.height + "&r=" + Math.random();-->
<!--<!--        document.getElementsByTagName("head")[0].appendChild(script);</script>-->
<!--<!--    <script-->
<!--<!--        type="text/javascript">new Image().src = "http://ucounter.ucoz.net/" + Math.random() + ".gif?cid=ucoz&r64=" + window.btoa(document.referrer) + "&cb=" + Math.random();</script>-->
<!--<!--</div>-->
<!---->
