<?php
/**
 * @var $params array
 * @var $agreement UserAgreements
 */
$agreement = $params[0];
$comment = $params[1];
?>
<h4>Повідомлення!</h4>
<br>
Твій запит на затвердження паперового договору до сервісу <strong><?php echo $agreement->service->description ?></strong>
</strong> відхилено <?php if(!empty($comment)){ ?> з коментарем "<em><?php echo $comment ?></em>"<?php } ?>