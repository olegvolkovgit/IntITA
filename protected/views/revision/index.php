<?php
// $lectures

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'lecturePages',
    'htmlOptions' => array('class' => 'grid-view custom', 'style' => 'margin-top:100px'),
    'emptyText' => '',
    'summaryText' => '',
    'dataProvider' =>$lectures,
    "columns" => array(
        'id_revision',
        'id_parent',
        'id_lecture',
        'id_module',
        'id_properties',

        array('name'=>'id', 'value'=>'$data->properties->id'),
        array('name'=>'image', 'value'=>'$data->properties->image'),
        array('name'=>'alias', 'value'=>'$data->properties->alias'),
        array('name'=>'order', 'value'=>'$data->properties->order'),
        array('name'=>'id_type', 'value'=>'$data->properties->id_type'),
        array('name'=>'is_free', 'value'=>'$data->properties->is_free'),
        array('name'=>'title_ua', 'value'=>'$data->properties->title_ua'),
        array('name'=>'title_ru', 'value'=>'$data->properties->title_ru'),
        array('name'=>'title_en', 'value'=>'$data->properties->title_en'),
        array('name'=>'start_date', 'value'=>'$data->properties->start_date'),
        array('name'=>'id_user_created', 'value'=>'$data->properties->id_user_created'),
        array('name'=>'send_approval_date', 'value'=>'$data->properties->send_approval_date'),
        array('name'=>'id_user_sended_approval', 'value'=>'$data->properties->id_user_sended_approval'),
        array('name'=>'reject_date', 'value'=>'$data->properties->reject_date'),
        array('name'=>'id_user_rejected', 'value'=>'$data->properties->id_user_rejected'),
        array('name'=>'approve_date', 'value'=>'$data->properties->approve_date'),
        array('name'=>'id_user_approved', 'value'=>'$data->properties->id_user_approved'),
        array('name'=>'end_date', 'value'=>'$data->properties->end_date'),
        array('name'=>'id_user_cancelled', 'value'=>'$data->properties->id_user_cancelled'),

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

<script>

    function newRevision(element){
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/newlecturerevision",
            data: {idLecture:id}
        })
    }

    function editRevision(element) {
        var id = $(element).parent().parent().find("td:first").text();
        location.href = "/revision/EditLectureRevision/?idRevision=" + id;
    }

    function sendRevision(element) {
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/SendForApproveLecture",
            data: {idLecture:id}
        })
    }

    function reject(element) {
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/rejectLectureRevision",
            data: {idLecture:id}
        })
    }

    function approve(element) {
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/approveLectureRevision",
            data: {idLecture:id}
        })
    }

    function cancel(element) {
        var id = $(element).parent().parent().find("td:first").text();

        $.ajax({
            method: "POST",
            url: "/revision/cancelLectureRevision",
            data: {idLecture:id}
        })
    }

</script>