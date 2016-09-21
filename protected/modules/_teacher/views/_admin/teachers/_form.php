<?php
/* @var $model Teacher */
/* @var $form CActiveForm */
/* @var $scenario string
 * @var $predefinedUser StudentReg
 * @var $message int
 */
?>
<script>
    scenario = '<?=(isset($predefinedUser)) ? "definedUser" : "";?>';
</script>
<div class="col-md-12">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'teacher-form',
        'htmlOptions' => array(
//            'class' => 'formatted-form',
            'enctype' => 'multipart/form-data',
            'method' => 'POST',
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'afterValidate' => 'js:function(form,data,hasError){
                if(data["Teacher_user_id"]){
                    bootbox.alert(data["Teacher_user_id"][0]); return false;
                 } else {
                    sendError(form,data,hasError);return true;
                 }
          }',
        )
    )); ?>

    <div class="form-group">
        <?php if ($scenario == "create") { ?>
            <label class="required" style="display:block">Користувач *</label>
            <input id="typeahead" type="text" class="form-control" placeholder="Користувач"
                   size="50" autofocus required>
        <?php } ?>
    </div>

    <div class="form-group">
        <div id="userInfo">
            <?php if ($scenario == "update") { ?>
                <a href="<?= Yii::app()->createUrl('studentreg/profile', array('idUser' => $model->user_id)); ?>"
                   target="_blank">
                    <?= $model->getName() . " <" . $model->user->email . "> " ?></a>
                <br>
                <?= ($model->skype() == "" ? "" : "skype: " . $model->skype()); ?> <?= ($model->phone() == "" ? "" : ", phone: " . $model->phone()); ?>
                <br>
            <?php } ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'first_name_en'); ?>
        <?php echo $form->textField($model, 'first_name_en',
            array('size' => 35, 'maxlength' => 35, 'class' => 'form-control', 'required' => 'required')); ?>
        <?php echo $form->error($model, 'first_name_en'); ?>
        <?php if ($scenario == "update") { ?>
            <a href="#" onclick="generateFirst('<?= $model->user->firstName; ?>'); return false;">
                Згенерувати автоматично</a>
        <?php } ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'middle_name_en'); ?>
        <?php echo $form->textField($model, 'middle_name_en',
            array('size' => 35, 'maxlength' => 35, 'class' => 'form-control', 'required' => 'required')); ?>
        <?php echo $form->error($model, 'middle_name_en'); ?>
        <?php if ($scenario == "update") { ?>
            <a href="#" onclick="generateMiddle('<?= $model->user->middleName; ?>'); return false;">
                Згенерувати автоматично</a>
        <?php } ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'last_name_en'); ?>
        <?php echo $form->textField($model, 'last_name_en',
            array('size' => 35, 'maxlength' => 35, 'class' => 'form-control', 'required' => 'required')); ?>
        <?php echo $form->error($model, 'last_name_en'); ?>
        <?php if ($scenario == "update") { ?>
            <a href="#" onclick="generateLast('<?= $model->user->secondName; ?>'); return false;">
                Згенерувати автоматично</a>
        <?php } ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'first_name_ru'); ?>
        <?php echo $form->textField($model, 'first_name_ru',
            array('size' => 35, 'maxlength' => 35, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'first_name_ru'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'middle_name_ru'); ?>
        <?php echo $form->textField($model, 'middle_name_ru',
            array('size' => 35, 'maxlength' => 35, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'middle_name_ru'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'last_name_ru'); ?>
        <?php echo $form->textField($model, 'last_name_ru',
            array('size' => 35, 'maxlength' => 35, 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'last_name_ru'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'profile_text_first'); ?>
        <?php echo $form->textArea($model, 'profile_text_first',
            array('rows' => 6, 'cols' => 50, 'class' => 'form-control', 'style' => 'resize: vertical')); ?>
        <?php echo $form->error($model, 'profile_text_first'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'profile_text_short'); ?>
        <?php echo $form->textArea($model, 'profile_text_short',
            array('rows' => 6, 'cols' => 50, 'class' => 'form-control', 'style' => 'resize: vertical')); ?>
        <?php echo $form->error($model, 'profile_text_short'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'profile_text_last'); ?>
        <?php echo $form->textArea($model, 'profile_text_last',
            array('rows' => 6, 'cols' => 50, 'class' => 'form-control', 'style' => 'resize: vertical')); ?>
        <?php echo $form->error($model, 'profile_text_last'); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', array('class' => 'btn btn-primary', 'id' => 'submitButton')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->textField($model, 'user_id',
            array('class' => 'form-control', 'id' => 'userIdHidden'));
        ?>
    </div>
    <input id="columnHidden" type="text" class="form-control" name="message" value="<?= (isset($message)) ? $message : 0; ?>">
    <input id="columnHidden" type="text" class="form-control" name="user"
           value="<?= (isset($predefinedUser)) ? $predefinedUser->id : 0; ?>">

    <?php $this->endWidget(); ?>
</div>
<script>
    var users = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_admin/teachers/usersByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (users) {
                return $jq.map(users.results, function (user) {
                    return {
                        id: user.id,
                        name: user.lastName + " " + user.firstName + " " + user.middleName,
                        firstName: user.firstName,
                        lastName: user.lastName,
                        middleName: user.middleName,
                        email: user.email,
                        skype: user.skype,
                        phone: user.tel,
                        url: user.url,
                        info: user.lastName + " " + user.firstName + " " + user.middleName + ", " + user.email
                    };
                });
            }
        }
    });
    users.initialize();

    if (scenario == "definedUser") {
        $jq('#typeahead').val('<?=(isset($predefinedUser)) ? addslashes(CHtml::decode($predefinedUser->userNameWithEmail())) : "";?>');
        $jq("#userIdHidden").val('<?=(isset($predefinedUser)) ? $predefinedUser->id : 0;?>');
    }

    $jq('#typeahead').typeahead(null, {
        name: 'users',
        display: 'email',
        limit: 10,
        source: users,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає користувачів з таким іменем або email\`ом',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><img class='typeahead_photo' src='{{url}}'/> <div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div><div class='typeahead_secondary'>{{email}}</div></div></div>")
        }
    });

    $jq('#typeahead').on('typeahead:selected', function (e, item) {
        $jq("#userIdHidden").val(item.id);
        $jq("#userInfo").html(item.info);
        $jq("#firstName").val(item.firstName);
        $jq("#lastName").val(item.lastName);
        $jq("#middleName").val(item.middleName);
        generateEnglishName(item.firstName, item.lastName, item.middleName);
    });
</script>