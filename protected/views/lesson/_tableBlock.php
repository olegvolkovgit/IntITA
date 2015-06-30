<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:36
 */

?>
    <link rel="stylesheet" media="screen" href="http://handsontable.com/dist/handsontable.full.css">
    <script src="http://handsontable.com/dist/handsontable.full.js"></script>

    <div class="element">
        <?php $this->renderPartial('_editToolbar', array(
            'idLecture' => $data['id_lecture'],
            'order' =>  $data['block_order'],
            'editMode' => $editMode,
        ));?>

        <div class="text" id="<?php echo "t" .  $data['block_order'];?>" onclick="function(){order = this.id;}">
            <?php echo $data['html_block'];?>
            <?php $idValue = "#" .  $data['block_order'];?>
        </div>
    </div>
<button id="load">Load</button>
<button id="save">Save</button>


<div id="example1"></div>
<br>
<br>
<div id="example1console"></div>

<script>
    var
        $$ = function(id) {
            return document.getElementById(id);
        },
        container = $$('example1'),
        exampleConsole = $$('example1console'),
        autosave = $$('autosave'),
        load = $$('load'),
        save = $$('save'),
        autosaveNotification,
        hot;

    hot = new Handsontable(container, {
        startRows: 8,
        startCols: 6,
        rowHeaders: true,
        colHeaders: true,
        afterChange: function (change, source) {
            if (source === 'loadData') {
                return; //don't save this change
            }
            if (!autosave.checked) {
                return;
            }
            clearTimeout(autosaveNotification);
            ajax('scripts/json/save.json', 'GET', JSON.stringify({data: change}), function (data) {
                exampleConsole.innerText  = 'Autosaved (' + change.length + ' ' + 'cell' + (change.length > 1 ? 's' : '') + ')';
                autosaveNotification = setTimeout(function() {
                    exampleConsole.innerText ='Changes will be autosaved';
                }, 1000);
            });
        }
    });

    Handsontable.Dom.addEvent(load, 'click', function() {
        ajax('scripts/json/load.json', 'GET', '', function(res) {
            var data = JSON.parse(res.response);

            hot.loadData(data.data);
            exampleConsole.innerText = 'Data loaded';
        });
    });

    Handsontable.Dom.addEvent(save, 'click', function() {
        // save all cell's data
        ajax('scripts/json/save.json', 'GET', JSON.stringify({data: hot.getData()}), function (res) {
            var response = JSON.parse(res.response);

            if (response.result === 'ok') {
                exampleConsole.innerText = 'Data saved';
            }
            else {
                exampleConsole.innerText = 'Save error';
            }
        });
    });

    Handsontable.Dom.addEvent(autosave, 'click', function() {
        if (autosave.checked) {
            exampleConsole.innerText = 'Changes will be autosaved';
        }
        else {
            exampleConsole.innerText ='Changes will not be autosaved';
        }
    });
</script>
