<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:36
 */

?>
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
<?php
// use editor WYSIWYG Imperavi
if ($editMode) {
    $this->widget('ImperaviRedactorWidget', array(
        'selector' => "#",
        'options' => array(
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
            'imagemanager' => array(
                'js' => array('imagemanager.js',),
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
        ),
    ));
}
?>