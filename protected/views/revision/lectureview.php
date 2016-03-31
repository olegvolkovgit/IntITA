<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'revision-lecture-properties-a-form',
    'enableAjaxValidation'=>false,
    'action'=>'/revision/editLectureProperties'
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($lectureRevision->properties); ?>

    <?php foreach($lectureRevision as $key=>$value) {?>
        <div class="row">
            <?php echo $form->labelEx($lectureRevision, $key, array("style" => "width:250px;display:inline-block")); ?>
            <?php echo $form->textField($lectureRevision, $key); ?>
            <?php echo $form->error($lectureRevision, $key); ?>
        </div>
    <?php } ?>

<div class="row buttons">
    <?php echo CHtml::submitButton('Submit'); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'revision-lecture-properties-a-form',
    'enableAjaxValidation'=>false,
    'action'=>'/revision/editLectureProperties'
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($lectureRevision->properties); ?>

    <?php foreach($lectureRevision->properties as $key=>$value) {?>
        <div class="row">
            <?php echo $form->labelEx($lectureRevision->properties, $key, array("style" => "width:250px;display:inline-block")); ?>
            <?php echo $form->textField($lectureRevision->properties, $key); ?>
            <?php echo $form->error($lectureRevision->properties, $key); ?>
        </div>
    <?php } ?>

<div class="row buttons">
    <?php echo CHtml::submitButton('Submit'); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div id="check" style="color:red;">
</div>

<br>
<button onclick="addPage(<?=$lectureRevision->id_revision?>);">Add Page</button>
<button onclick="checkLecture(<?=$lectureRevision->id_revision?>);">Check Lecture</button>
<button onclick="approveLecture(<?=$lectureRevision->id_revision?>);">Send for approve Lecture</button>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'lecturePages',
    'htmlOptions' => array('class' => 'grid-view custom'),
    'emptyText' => '',
    'summaryText' => '',
    'dataProvider' =>$pages,
    "columns" => array(
        'id',
        'id_page',
        'id_parent_page',
        'id_revision',
        'page_title',
        'page_order',
        'video',
        'quiz',
        'start_date',
        'id_user_created',
        'update_date',
        'id_user_updated',
        'send_approval_date',
        'id_user_sended_approval',
        'reject_date',
        'id_user_rejected',
        'approve_date',
        'id_user_approved',
        'end_date',
        'id_user_cancelled',
        array('class'=>'CButtonColumn',
            'template'=>'{edit} | {send} | {new} | {approve} | {reject} | {cancel} | {up} | {down}',
            'htmlOptions'=>array('width'=>'400'),
            'buttons'=>array (
                'edit'=> array(
                    'label'=>'Edit',
                    'options'=>array('onclick'=>'editRevision(this)'),
                ),
                'send'=> array(
                    'label'=>'Send',
                    'options'=>array('onclick'=>'sendRevision(this)'),
                ),
                'new'=> array(
                    'label'=>'New Revision',
                    'options'=>array('onclick'=>'newRevision(this)'),
                ),
                'approve'=>array(
                    'label'=>'Approve',
                    'options'=>array('onclick'=>'approve(this)'),
                ),
                'reject'=>array(
                    'label'=>'Reject',
                    'options'=>array('onclick'=>'reject(this)'),
                ),
                'cancel' => array(
                    'label' => 'Cancel',
                    'options' => array('onclick' => 'cancel(this)'),
                ),
                'up' => array(
                    'label' => 'Up',
                    'options' => array('onclick' => 'up(this)'),
                ),
                'down' => array(
                    'label' => 'Down',
                    'options' => array('onclick' => 'down(this)'),
                )
            ),
        ),
    )
));

?>
<div id="ajax_content">
</div>

<script>
    function addPage(lectureRevision) {
        $.ajax({
            method: "POST",
            url: "/revision/addpage",
            data: {idRevision:lectureRevision}
        })
    }

    function editRevision(element) {
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/editpagerevision",
            data: {idPage:id},
            success: function(data) {
                        $('#ajax_content').html(data);
            }
        })
    }

    function sendRevision(element) {
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/sendpagerevision",
            data: {idPage:id}
        })
    }

    function approve(element) {
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/approvepagerevision",
            data: {idPage:id}
        })
    }

    function reject(element) {
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/rejectpagerevision",
            data: {idPage:id}
        })
    }

    function cancel(element) {
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/cancelpagerevision",
            data: {idPage:id}
        })
    }

    function newRevision(element){
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/newpagerevision",
            data: {idPage:id}
        })
    }

    function up(element) {
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/uppage",
            data: {idPage:id}
        })
    }

    function down(element) {
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/downpage",
            data: {idPage:id}
        })
    }

    function checkLecture(id) {
        $.ajax({
            method: "POST",
            url: "/revision/checkLecture",
            data: {idLecture:id},
            success: function(data) {
                $('#check').html(data);
            }
        })
    }

    function approveLecture() {
        $.ajax({
            method: "POST",
            url: "/revision/SendForApproveLecture",
            data: {idLecture:<?=$lectureRevision->id_revision?>}
        })
    }

    function upElement(idEl, idPage) {
        $.ajax({
            method: "POST",
            url: "/revision/upLectureElement",
            data: {idElement:idEl, idPage:idPage}
        })
    }

    function downElement(idEl, idPage) {
        $.ajax({
            method: "POST",
            url: "/revision/downLectureElement",
            data: {idElement:idEl, idPage:idPage}
        })
    }

    function deleteElement(idEl, idPage) {
        $.ajax({
            method: "POST",
            url: "/revision/deleteLectureElement",
            data: {idElement:idEl, idPage:idPage}
        })
    }

</script>
