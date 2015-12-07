<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 23.11.2015
 * Time: 16:59
 */
if(!empty($users)){
    ?>
    Список користувачів по e-mail користувача
    <?php

    foreach($users as $user)
    {?>
        <div>
            <input type="radio" name="user" value="<?php echo $user->id ?>" onchange="getAgreementsListByUser()">
            Користувач :<?php echo $user->getUserNamePayment() ?>
            Ім'я : <?php echo $user->getFirstName() ?>
    </div>
    <?php }?>

<?php } ?>