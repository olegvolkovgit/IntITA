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
                        <td width="30%"><strong>Ім'я (рус.)</strong></td>
                        <td>
                            <?= $model->first_name_ru; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Прізвище (рус.)</strong></td>
                        <td>
                            <?= $model->last_name_ru; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>