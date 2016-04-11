<script>
    function addBlockToTable($table, id, type, content) {
        var $row = $('<tr></tr>');
        var typeName = '';
        switch (type) {
            case 1:
                typeName = "Текст";
                break;
            case 3:
                typeName = "Код";
                break;
            case 4:
                typeName = "Приклад";
                break;
            case 7:
                typeName = "Інструкція";
                break;
            default:
                typeName = "Текст";
                break;
        }
        var $name = $('<td></td>').html(typeName).appendTo($row);
        var $textarea = $('<textarea></textarea>').attr('id', id).addClass('form-control').html(content).appendTo($row);
        var $content = $('<td></td>').append($textarea).appendTo($row);
        var $button = $('<td><input class="btn btn-default" type="button" value="Зберегти"></td>').appendTo($row);
        $row.appendTo($table);
    }
</script>

<table class="table" id="pageView">
    <tr>
        <td>Назва</td>
        <td><input type="text" class="form-control" id="title" value="<?=$page->page_title?>"/></td>
        <td><input class="btn btn-default" type="button" value="Зберегти"></td>
    </tr>
    <tr>
        <td>Відео</td>
        <td><input type="text" class="form-control" id="video" value="<?=(isset($video)?$video->html_block:"") ?>"/></td>
        <td><input class="btn btn-default" type="button" value="Зберегти"></td>
    </tr>
    <?php
    if (isset($lectureBody)) {
        foreach ($lectureBody as $lectureElement) { ?>
            <script>
                addBlockToTable($('#pageView'), <?=$lectureElement->id?>, <?=$lectureElement->id_type?>, '<?=$lectureElement->html_block?>');
            </script>
        <?php
        }
    }?>

    <tr>
        <td>
            <div class="form-group">
                <select class="form-control" id="type">
                    <option value="1">Текст</option>
                    <option value="3">Код</option>
                    <option value="4">Приклад</option>
                    <option value="7">Інструкція</option>
                </select>
            </div>
        </td>
        <td><input type="text" class="form-control" id="vieo" value=""/></td>
        <td><input class="btn btn-default" type="button" value="Додати"></td>
    </tr>
</table>

<h1>Quiz</h1>
<?php
?>
