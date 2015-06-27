<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:36
 */
$formulaCode = addcslashes($data['html_block'], '\\');
?>
<head>
    <script type="text/javascript" src="http://latex.codecogs.com/editor3.js"></script>
</head>

    <div class="element">
        <?php $this->renderPartial('_editToolbar', array(
            'idLecture' => $data['id_lecture'],
            'order' =>  $data['block_order'],
            'editMode' => $editMode,''
        ));?>

        <div class="formula" id="<?php echo "t" .  $data['block_order'];?>"
             onclick="
                 openEditor('<?php echo 'editFormula'.$data['block_order'];?>',
                 '<?php echo $formulaCode;?>',
                 '<?php echo 'content'.$data['block_order'];?>')">
            <?php echo $data['html_block'];?>
        </div>
            <form id="editFormula<?php echo $data['block_order'];?>" action="<?php echo Yii::app()->createUrl('/lesson/save');?>"
                  method="post"
                  style="display:none;">
                <input name="idLecture" value="<?php echo $data['id_lecture'];?>" hidden="hidden">
                <input name="order" value="<?php echo $data['block_order'];?>" hidden="hidden">
                <textarea name="content<?php echo $data['block_order'];?>"
                          id="content<?php echo $data['block_order'];?>" cols="108" rows="10">
                    <?php echo $data['html_block'];?>
                </textarea>
                <br>
                <input type="submit" value="Зберегти" onclick="sendContent('<?php echo 'content'.$data['block_order'];?>')">
            </form>
    </div>
<script type="text/javascript">
    function openEditor(id, data, textarea) {
        document.getElementById(id).style.display = "block";
        document.getElementById(textarea).innerText = '';
        OpenLatexEditor(textarea, "latex", "uk_uk", "true", data);

    }
    function sendContent(id){
        contentValue = document.getElementById(id).value;
        idLecture =  document.getElementById('idLecture').innerText;
        order =  document.getElementById('order').innerText;

        $.ajax({
            cache: false,
            type: "POST",
            url: '/lesson/save',
            data: {'content':contentValue,'idLecture':idLecture,'order':order}
        });
    }
</script>
