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
                        <td width="30%"><strong>Ім'я (англ.)</strong></td>
                        <td>
                            <?= $model->first_name_en; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Прізвище (англ.)</strong></td>
                        <td>
                            <?= $model->last_name_en; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>