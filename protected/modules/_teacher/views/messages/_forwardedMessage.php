<?php
/**
 * @var $message UserMessages
 * @var $forwarded UserMessages
 */
?>
<blockquote>
    <p>  <?php
        if($forwarded->type() == MessagesType::USER){
            echo CHtml::encode($forwarded->text());
        } else {
            echo $forwarded->text();
        }
        ?></p>
    <small>
        <em><?= CommonHelper::formatMessageDate($forwarded->message0->create_date).", користувач <strong>".$forwarded->message0->sender0->userName() .
        ", " . $forwarded->message0->sender0->email . "</strong>" ?></em>
    </small>
</blockquote>
