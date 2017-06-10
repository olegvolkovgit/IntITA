<? $css_version = 1; ?>
<h3>Ресурси для співробітників</h3>
<ul>

    <?php
    foreach($shareLink as $share)
    {
        echo ('<li>'.$share['name'].' - <a href='.$share['link'].' target="_blank">'.$share['link'].'</a>');
    }
    ?>


</ul>
