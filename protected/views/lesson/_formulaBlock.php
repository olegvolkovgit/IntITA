<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:36
 */
$temp = substr($data['html_block'], 2, count($data['html_block']) - 5);
$formulaCode = addcslashes($temp, '\\');
?>
    <div class="element">
        <?php $this->renderPartial('_editToolbar', array(
            'idLecture' => $data['id_lecture'],
            'order' =>  $data['block_order'],
            'editMode' => $editMode,''
        ));?>

        <div class="formula" id="<?php echo "t" .  $data['block_order'];?>"
             <?php if($editMode){?>
             onclick="
                 openEditor('<?php echo 'editFormula'.$data['block_order'];?>',
                 '<?php echo $formulaCode;?>',
                 '<?php echo 'content'.$data['block_order'];?>')"
            <?php }?>
            >
            <?php echo $data['html_block'];?>
        </div>
            <form class="editFormula" id="editFormula<?php echo $data['block_order'];?>"
                  action="<?php echo Yii::app()->createUrl('lesson/saveFormula');?>"
                  method="post"
                  style="display:none;">
                <input id="idLecture" name="idLecture" value="<?php echo $data['id_lecture'];?>" hidden="hidden">
                <input id="order" name="order" value="<?php echo $data['block_order'];?>" hidden="hidden">
                <textarea name="content"
                          id="content<?php echo $data['block_order'];?>" cols="108" rows="10" required onclick="buttonEditFormulaEnabled()">
                    <?php echo $data['html_block'];?>
                </textarea>
                <br>
                <input class="editFormulaButton" type="submit" value="Зберегти" onclick="sendContent('<?php echo 'content'.$data['block_order'];?>')">
                <input class="editFormulaCancel" type="submit" value="Скасувати" onclick='cancelEditFormula()'>
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

        idLecture =  document.getElementById('idLecture').value;
        order =  document.getElementById('order').value;

        var val = $("#"+id).val().trim();
        if(val=="\\[\\]"){
            alert('Формула не може бути пуста');
            $(".editFormulaButton").attr('disabled',true);
            return false;
        }

        $.ajax({
            cache: false,
            type: "POST",
            url: '/lesson/save',
            data: {'content':contentValue,'idLecture':idLecture,'order':order}
        });
    }
    function buttonEditFormulaEnabled(){
        $(".editFormulaButton").removeAttr('disabled');
    }
    function cancelEditFormula(){
        $(".editFormulaCancel").attr('disabled',true);
        location.reload();
    }
</script>
