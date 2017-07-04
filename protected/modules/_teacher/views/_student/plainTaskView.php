<?php
/**
 * @var $plainTaskMarks PlainTaskMarks
 */
?>
<div class="panel panel-default">
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td>
                        <label>Завдання</label>
                        <div class="form-control" name="condition" style="height: auto" readonly>
                            <?php echo $plainTaskMark->taskAnswer->getCondition() ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Відповідь</label>
                        <textarea class="form-control" name="condition" readonly id="textareaSettingsbyId">
                            <?php echo $plainTaskMark->taskAnswer->answer; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Коментар</label>
                        <div class="form-control" name="comment" style="height: auto">
                            <?=$plainTaskMark->comment ;?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Оцінка</label>
                        <span ng-if="<?php echo $plainTaskMark->mark==1 ?>">зарах.</span>
                        <span ng-if="<?php echo $plainTaskMark->mark==0 ?>">не зарах.</span>
                        <span ng-if="<?php echo !$plainTaskMark ?>">не перевірено</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Викладач</label>
                        <a href="/profile/<?php echo $plainTaskMark->markedBy->fullName ?>" target="_blank">
                            <?php echo $plainTaskMark->markedBy->fullName ?>
                        </a>
                        <a class="btnChat" ng-if="<?php echo $plainTaskMark->markedBy->id ?>" ng-href="#/newmessages/receiver/<?php echo $plainTaskMark->markedBy->id ?>"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <a class="btnChat" ng-if="<?php echo $plainTaskMark->markedBy->id ?>" href="<?php echo Config::getChatPath(); ?><?php echo $plainTaskMark->markedBy->id ?>" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                            <i class="fa fa-weixin fa-fw"></i>
                        </a>
                    </td>
                </tr>
            </table>
            <div class="form-group">
                <a href="" type="button" class="btn btn-default" ng-click="back()">
                    Назад
                </a>
            </div>
        </div>
    </div>
</div>