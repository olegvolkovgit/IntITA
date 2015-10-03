<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 29.08.2015
 * Time: 15:13
 */
?>
<h3>Ресурси для викладачів</h3>
<ul>
    <?php
    foreach($shareLink as $share)
    {
        echo ('<li>'.$share['name'].' - <a href='.$share['link'].' target="_blank">'.$share['link'].'</a>');
    }
    ?>

</ul>
<a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => 77));?>">Link</a>