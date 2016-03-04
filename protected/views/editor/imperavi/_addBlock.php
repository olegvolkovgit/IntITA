<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 19.05.2015
 * Time: 16:58
 */
?>

<a name="newBlockForm"></a>
    <div id="blockForm">
        <div id="textBlockForm">
            <form id="addBlockForm" action="<?php echo Yii::app()->createUrl('revision/createNewBlock'); ?>"
                  method="post">
                <input name="idLecture" value="<?php echo $lecture->id; ?>" type="hidden">
                <input name="type" value="" id="blockType" type="hidden">
                <input name="page" value="<?php echo $pageOrder;?>" id="page" type="hidden">
                <textarea name="editorAdd" id="newTextBlock" cols="108" class="wm ontop"
                          required form="addBlockForm" rows="10">
                </textarea>
                <div class="container">
                    <div id="toolbar"></div>
                    <br>
                    <div class="inner">
                        <textarea placeholder="Формула для вставки в блок" class="source" data-source="insert" id="formulaContainer"></textarea>
                        <label><input id="inlineFormula" type="checkbox" checked/>Формула в тексті</label>
                        <img id="equation" align="center"/>
                    </div>
                    <div style="font-size: 12px">Поставте курсор в текстовий блок та вставте LaTeX формулу</div>
                    <button type="button" class="action" data-action="insert">Вставити формулу</button>
                </div>
                <br>
                <br>
                <input type="submit" value="<?php echo Yii::t('lecture', '0712'); ?>" id="addBlockSubmit" onclick="saveNewBlock();">
            </form>
            <button id="cancelButton"
                    onclick="hideForm('blockForm', 'newTextBlock')"><?php echo Yii::t('course', '0368') ?></button>
        </div>
    </div>
    <?php
        $this->widget('ImperaviRedactorWidget', array(
            'selector' => "#newTextBlock",
            'options' => array(
                'imageUpload' => $this->createUrl('lesson/uploadImage'),
                'lang' => CommonHelper::getLanguage(),
                'toolbar' => true,
                'iframe' => true,
                'css' => 'wym.css',
            ),
            'plugins' => array(
                'fullscreen' => array(
                    'js' => array('fullscreen.js',),
                ),
                'table' => array(
                    'js' => array('table.js',),
                ),
                'fontsize' => array(
                    'js' => array('fontsize.js',),
                ),
                'fontfamily' => array(
                    'js' => array('fontfamily.js',),
                ),
                'fontcolor' => array(
                    'js' => array('fontcolor.js',),
                ),
                'save' => array(
                    'js' => array('save.js',),
                ),
                'close' => array(
                    'js' => array('close.js',),
                ),
                'closefullscreen' => array(
                    'js' => array('closefullscreen.js',),
                ),
            ),
        ));

    ?>
    <script type="text/javascript">
        $(window).load(function() {
            document.getElementById('toolbar').style.display = "block";
            EqEditor.embed('toolbar', '', 'full', 'uk-uk');
            var a = new EqTextArea('equation', 'formulaContainer');
            EqEditor.add(a, false);
        })
    </script>
