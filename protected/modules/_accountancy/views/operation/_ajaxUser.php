<?php
/**
 * @var $user StudentReg
 */
if(!empty($users)){
    ?>
    Список користувачів по e-mail користувача
    <?php
    foreach($users as $user)
    {?>
        <div>
            <input type="radio" name="user" value="<?php echo $user->id ?>" onchange="getAgreementsListByUser()">
            Користувач :<?php echo $user->email.", ".$user->firstName." ".$user->secondName; ?>
            Ім'я : <?php echo $user->firstName;?>
    </div>
    <?php }?>

<?php } ?>