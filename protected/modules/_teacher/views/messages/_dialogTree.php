<?php
/**
 * @var $message UserMessages
 */
?>
<h4><?=$message->subject;?></h4>
<p>
    <?=$message->text;?>
</p>
<em><?=$message->message()->create_date;?></em>
