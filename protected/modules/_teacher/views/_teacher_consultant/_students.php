<?php
/**
 * @var $students array
 * @var $student StudentReg
 */
?>
<div class="row">
    <?php if (!empty($students)) { ?>
        <table class="table table-hover">
            <tbody>
            <tr>
                <td width="20%">Студенти:</td>
                <td>
                    <ul>
                        <?php foreach ($students as $student) {
                            ?>
                            <li>
                                <a ng-href="#/users/profile/<?php echo $student['id_student'] ?>">
                                    <?= trim($student['firstName'].' '.$student['secondName'].' '.$student['email']); ?>
                                </a>
                                Модуль:
                                <a href="<?= Yii::app()->createUrl("module/index", array("idModule" => $student['id_module'])); ?>"
                                   target="_blank">
                                    <?= $student['title_ua'].' ('.$student['language'].')'; ?>
                                </a>
                            </li>
                            <?php
                        } ?>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    <?php } else {
        echo "Студентів для викладача не призначено.";
    } ?>
</div>
