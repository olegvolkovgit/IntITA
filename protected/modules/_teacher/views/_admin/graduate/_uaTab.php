<?php
/**
 * @var $model Graduate
 */
?>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td width="30%"><strong>Ім'я (укр.)</strong></td>
                        <td>
                            <?= $model->first_name; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Прізвище (укр.)</strong></td>
                        <td>
                            <?= $model->last_name; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>