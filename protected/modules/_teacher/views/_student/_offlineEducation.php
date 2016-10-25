<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <div class="form-group">
                    <label>Група:</label>
                    <input class="form-control" value="<?php echo $group ?>" required maxlength="128" size="50" disabled>
                </div>
                <div class="form-group">
                    <label>Підгрупа:</label>
                    <input class="form-control" value="<?php echo $subgroup ?>" required maxlength="128" size="50" disabled>
                </div>
                <div class="form-group">
                    <label>Інофрмація(розклад):</label><a target="_blank" href="<?php echo $info ?>" ><?php echo $info ?></a>
                </div>
                <div class="form-group">
                    <label>Тренер: </label>
                    <a href="<?php echo Yii::app()->createUrl('studentreg/profile', array('idUser' => $trainerId)) ?>" target="_blank">
                        <?php echo $trainer ?>
                    </a>
                    <br>
                    Написати повідомлення:
                    <a ng-href="<?= Yii::app()->createUrl('/cabinet/#/newmessages/receiver/'); ?><?php echo $trainerId ?>">
                        <?php echo $trainerEmail ?>
                        <i class="fa fa-envelope fa-fw"></i>
                    </a>
                    Приватний чат:
                    <a href="<?= Config::getChatPath()?><?php echo $trainerId ?>" target="_blank">почати чат <i class="fa fa-wechat fa-fw"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>