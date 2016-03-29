<?php
/* @var $this ConfigController */
/* @var $model Config */
?>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/config/index'); ?>', 'Налаштування')">
            Список налаштувань
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/config/update',
                    array('id' => $model->id)); ?>', '<?="Редагувати налаштування ".$model->param; ?>')">
            Редагувати налаштування
        </button>
    </li>
</ul>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12">
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <td width="30%"><strong>Налаштування</strong></td>
                        <td><?= $model->param; ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Значення</strong></td>
                        <td>
                            <?= $model->value; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Значення (за замовчуванням)</strong></td>
                        <td>
                            <?= $model->default; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Опис</strong></td>
                        <td>
                            <?= $model->label; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%"><strong>Тип значення</strong></td>
                        <td>
                            <?= $model->type; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

