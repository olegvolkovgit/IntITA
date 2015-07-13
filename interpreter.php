<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 13.07.2015
 * Time: 16:57
 */
?>
<h2>Логи интерпретатора</h2>
<?php
echo "<pre>" . file_get_contents("/var/www/ii/log.txt") . "</pre>";
?>