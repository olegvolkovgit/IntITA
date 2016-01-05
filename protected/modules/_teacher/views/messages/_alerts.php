<?php
/**
 * @var $alerts array
 */
foreach($alerts as $alert){
?>
<div class="alert alert-<?=$alert['type']?> alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?=$alert['text']?><a href="#" class="alert-link">Відкрити діалог</a>.
</div>
<?php }?>

