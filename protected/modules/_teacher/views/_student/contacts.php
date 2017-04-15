<?php
/**
 * @var $trainers TrainerStudent
 */
?>
<div class="row">
    <table class="table table-hover">
        <tbody>
            <tr>
                <td width="20%">Тренер:</td>
                <td>
                    <?php if ($trainers) {
                        foreach ($trainers as $trainer) { ?>
                            <a href="/profile/<?php echo $trainer->trainer0->user_id ?>" target="_blank">
                                <?php echo $trainer->trainer0->getName() ?><?php echo $trainer->trainer0->user->email ?>
                                 (організація: <?php echo $trainer->organization->name ?>)
                            </a>
                            <a class="btnChat" ng-href="#/newmessages/receiver/<?php echo $trainer->trainer0->user_id ?>"
                               data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                                <i class="fa fa-envelope fa-fw"></i>
                            </a>
                            <a class="btnChat" href="<?php echo Config::getChatPath(); ?><?php echo $trainer->trainer0->user_id ?>" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                                <i class="fa fa-weixin fa-fw"></i>
                            </a>
                            <br>
                            <?php
                        }
                    } else {
                        echo "Тренер ще не призначений";
                    }?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
