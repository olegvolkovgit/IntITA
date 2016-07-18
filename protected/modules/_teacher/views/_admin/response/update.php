<?php
/* @var $this ResponseController */
/* @var $model Response */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/response/index'); ?>')">
            Відгуки про викладачів</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/response/view', array('id' => $model->id)); ?>')">
            Переглянути відгук</button>
    </li>
</ul>

    <div class="page-header">
    <h4>Редагувати відгук #<?php echo $model->id; ?></h4>
    </div>

    <link rel="stylesheet" type="text/css" href="<?=Yii::app()->baseUrl?>/css/formattedForm.css"/>

<div class="panel-body">
    <div class="row">
        <div class="col-lg-8">
            <form id="response-form" name="responseForm" onsubmit="editResponse('<?php echo Yii::app()->createUrl('/_teacher/_admin/response/updateResponseText', array('id'=>$model->id))?>');return false;">
                <div class="form-group">
                    <?php $model->text=Response::model()->html_to_bbcode($model->text); ?>
                    <label>Відгук*</label>
                    <textarea class="editor" id="response" name="responseText" ><?php echo $model->text ?></textarea>
                </div>
                <div class="form-group">
                    <label>Перевірено модератором</label>
                    <select class="form-control" name="Response[is_checked]" id="Response_is_checked">
                        <option value="1" <?php echo ($model->is_checked==1)?'selected':''?>>публікувати</option>
                        <option value="0"<?php echo ($model->is_checked==0)?'selected':''?>>приховати</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Зберегти</button>
            </form>
        </div>
    </div>
</div>


<!--<!-- Підключення BBCode WysiBB -->
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/jquery.wysibb.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/theme/default/wbbtheme.css'); ?>"
      type="text/css" />
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/lang/ua.js'); ?>"></script>
<!--<script src="--><?php //echo StaticFilesHelper::fullPathTo('js',  'wysibb/BBCode.js'); ?><!--"></script>-->
<script>
    $jq(document).ready(function() {
        var wbbOpt = {
            lang: "ua",
            buttons: "bold,italic,underline,|,code,bullist,numlist"
        };
        $jq("#response").wysibb(wbbOpt);
    });
    function editResponse(url) {
        response = $jq("#response").bbcode();
        if (response.trim() == '') {
            bootbox.alert('Відгук не може бути пустий.');
        } else {
            publish = document.getElementById("Response_is_checked").value;
            $jq.ajax({
                type: "POST",
                url: url,
                data: {
                    response: response,
                    publish: publish,
                },
                async: true,
                success: function (response) {
                    bootbox.alert(response, load('<?php echo Yii::app()->createUrl('/_teacher/_admin/response/view', array('id' => $model->id)); ?>'));
                },
                error: function () {
                    bootbox.alert("Операцію не вдалося виконати.");
                }
            });
        }
    }
</script>

<!-- Підключення BBCode WysiBB -->
