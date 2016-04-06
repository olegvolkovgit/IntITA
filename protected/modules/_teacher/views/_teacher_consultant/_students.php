<?php
/**
 * @var $students array
 * @var $student array
 */
?>
<div class="row">
    <table class="table table-hover">
        <tbody>
        <tr>
            <td width="30%">Студенти:</td>
            <td>
                <?php if (!empty($students["value"])) { ?>
                    <ul>
                        <?php foreach ($students["value"] as $student) {
                            ?>
                            <li>
                                <a href="<?= Yii::app()->createUrl("studentreg/profile", array("idUser" => $student["id"])); ?>"
                                   target="_blank">
                                    <?=$student["name"]." (".$student["email"].")";?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else {
                    echo "Студентів для викладача не призначено.";
                }?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
