<?php
/* @var $user StudentReg */
/* @var $users array */
?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="usersTable">
                    <thead>
                    <tr>
                        <th>ФІО</th>
                        <th>Email</th>
                        <th>Зареєстровано</th>
                        <th>Профіль</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $users = StudentReg::model()->findAll();
                    foreach($users as $user){
                        ?>
                        <tr class="odd gradeX">
                            <td><?=$user->userName();?></td>
                            <td class="center"><?=$user["email"];?></td>
                            <td class="center"><?php if($user["reg_time"] > 0) echo date("d-m-Y", $user["reg_time"]);
                                else echo '<em>невідомо</em>';
                                ?></td>
                            <td>
                                <a href="<?php echo Yii::app()->createUrl('/studentreg/profile', array('idUser' => $user->id)); ?>" target="_blank">
                                    Профіль користувача
                                </a>
                                <a class="btnChat"  href="<?=Yii::app()->createUrl('/_teacher/cabinet/index', array(
                                    'scenario' => 'message',
                                    'receiver' => $user->id
                                ));?>"  data-toggle="tooltip" data-placement="top" title="<?=Yii::t('teacher', '0795');?>">
                                    <i class="fa fa-envelope fa-fw"></i></a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>