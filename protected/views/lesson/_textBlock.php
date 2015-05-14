<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.04.2015
 * Time: 18:36                      onclick="loadRedactor('<?php echo "#".$order?>')"
 */
//echo $data;
?>
<div class="text" id="<?php echo "t" . $order;?>" >

    <?php echo $data;?>
    <?php $idValue = "#" . $order?>
</div>

<?php
// use editor WYSIWYG Imperavi
$this->widget('ImperaviRedactorWidget', array(
    // use editor to field .aboutStepBlock
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
        'advanced' => array(
            'js' => array('advanced.js',),
        ),
    ),
));
//    ?>

