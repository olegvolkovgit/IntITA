<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:36
 */
?>



<div class="text" id="<?php echo "t" . $order;?>" onclick="document.getElementById('saveButton').display = block;">
    <?php echo $data;?>
    <?php $idValue = "#" . $order?>
</div>

<?php
// use editor WYSIWYG Imperavi
if ($editMode) {
$this->widget('ImperaviRedactorWidget', array(
'selector' => "#",
'options' => array(
'imageUpload' => $this->createUrl('files/upload'),
'lang' => 'ua',
'toolbar' => true,
'iframe' => true,
'css' => 'wym.css',
),
'plugins' => array(
'fullscreen' => array(
'js' => array('fullscreen.js',),
),
'video' => array(
'js' => array('video.js',),
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
),
));
}
//    ?>

<script type="text/javascript">
   function pressSaveRedactor() {

        var selector = '#<?php echo "t" . $order;?>';

        // save content
        var text = $(selector).redactor('code.get');
        alert(text);

        // destroy editor
        $(selector).redactor('core.destroy');
        $('.btn-save-ImperaviSimple').hide();
    }
</script>

