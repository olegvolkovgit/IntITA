<?php
$this->breadcrumbs = array(
    Yii::t('breadcrumbs', '0050') => Yii::app()->createUrl('courses'),
);
//?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'course.css'); ?>"/>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'dist/css/sb-admin-2.css');?>" rel="stylesheet">
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/controllers/newModuleListCtrl.js'); ?>"></script>
<script type="text/javascript">
    basePath = '<?php echo Config::getBaseUrl();?>';
</script>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="modulesTable" style="width:100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Псевдонім</th>
                            <th>Мова</th>
                            <th>Назва</th>
                            <th>Статус</th>
                            <th>Рівень</th>
                            <th>Доступність</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'titleValidation.js'); ?>"></script>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/morrisjs/morris.css');?>" rel="stylesheet">
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        initModules();
    });
    function initModules(){
        $('#modulesTable').DataTable({
            "ajax": {
                "url": basePath + "/modules/getModulesList",
                "dataSrc": "data"
            },
            "columns": [
                {
                    "width": "8%",
                    "data": "id"
                },
                {
                    "width": "15%",
                    "data": "alias" },
                {
                    "width": "8%",
                    "data": "lang"
                },
                {
                    "data": "title",
                    "render": function (title) {
                        return '<a href="'  + title["mainLink"]+ '">'  + title["name"] + '</a>';
                    }
                },
                {
                    "width": "10%",
                    "data": "status"
                },
                {
                    "width": "17%",
                    "data": "level"
                },
                {
                    "width": "10%",
                    "data": "cancelled"
                }
            ],
            "createdRow": function (row, data, index) {
                $(row).addClass('gradeX');
            },
            language: {
                "url": basePath+"/scripts/cabinet/Ukranian.json",
            },
            processing : true,
            "order": [[ 0, "desc" ]]
        });
    }
</script>