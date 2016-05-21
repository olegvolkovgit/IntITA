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
                                <a href="<?= Yii::app()->createUrl("studentreg/profile", array("idUser" => $student->id)); ?>"
                                   target="_blank">
                                    <?= $student->userName() . " (" . $student->email . ")"; ?>
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
