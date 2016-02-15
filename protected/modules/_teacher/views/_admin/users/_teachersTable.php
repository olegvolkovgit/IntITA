<?php
/* @var $user StudentReg */
/* @var $teachers array */
?>
<div class="col-lg-12">
    <br>
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create'); ?>',
                'Додати викладача')">
        Додати викладача
    </button>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="teachersTable">
                    <thead>
                    <tr>
                        <th>ФІО</th>
                        <th>Email</th>
                        <th>Персональна сторінка</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($teachers as $user) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?= $user->userName(); ?></td>
                            <td class="center"><?= $user->email; ?></td>
                            <td class="center"><a href="<?=Yii::app()->createUrl('profile/index', array('idTeacher' => $user->getTeacherId()));?>">сторінка</a>
                                <a class="btnChat"  href="<?=Yii::app()->createUrl('/_teacher/cabinet/index', array(
                                    'scenario' => 'message',
                                    'receiver' => $user->id
                                ));?>"  data-toggle="tooltip" data-placement="top" title="<?=Yii::t('teacher', '0795');?>">
                                    <i class="fa fa-envelope fa-fw"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>