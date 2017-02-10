<?php
/**
 * @var $trainer Teacher
 */
?>
<div class="row">
    <table class="table table-hover">
        <tbody>
            <tr>
                <td width="20%">Тренер:</td>
                <td>
                    <?php if ($trainer) { ?>
                        <a href="/profile/<?php echo $trainer->user_id?>" target="_blank">
                            <?php echo $trainer->getName() ?> <?php echo $trainer->user->email?>
                        </a>
                        <a class="btnChat" ng-href="#/newmessages/receiver/<?php echo $trainer->user_id?>"
                           data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                    <?php } else {
                        echo "Тренер ще не призначений";
                    }?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
