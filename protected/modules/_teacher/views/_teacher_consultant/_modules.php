<?php
/**
 * @var $modules array
 * @var $module Module
 */
?>
<div class="row">
    <table class="table table-hover">
        <tbody>
        <tr>
            <?php if (!empty($modules)) { ?>
                <td width="20%">Модулі:</td>
                <td>
                    <ul>
                        <?php foreach ($modules as $module) { ?>
                            <li>
                                <a href="<?= Yii::app()->createUrl("module/index", array("idModule" => $module["id"])); ?>"
                                   target="_blank">
                                    <?= $module["title"] . " (" . $module["lang"] . ")"; ?>
                                </a>
                            </li>
                        <?php }
                        ?>
                    </ul>
                </td>
            <?php } else {
                echo "Модулів для викладача не призначено.";
            } ?>
        </tr>
        </tbody>
    </table>
</div>
