<?php
/* @var $this CabinetController
 * @var $model StudentReg
 * @var $scenario
 * @var $receiver
 * @var $course int
 * @var $module int
 * @var $requests array
 * @var $newMessages array
 * @var $countNewMessages int
 */
?>
<script>
    basePath = '<?=Config::getBaseUrl()?>';
    user = '<?=Yii::app()->user->getId()?>';
    scenario = '<?=$scenario?>';
    adminEmail = '<?=Config::getAdminEmail();?>';
    <!-- kludge -->
    if (location.hash === ''){
        location.hash='/index';
    }

</script>


<div id="wrapper" ng-controller="teacherCtrl">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <?php echo $this->renderPartial('_top_navigation', array(
            'model' => $model,
            'newMessages' => $newMessages,
            'requests' => $requests,
            'countNewMessages' =>$countNewMessages
        )); ?>
        <?php echo $this->renderPartial('_sidebar_navigation', array(
            'model' => $model,
            'countNewMessages' =>$countNewMessages
        )); ?>
    </nav>
    <?php echo $this->renderPartial('_page_wrapper', array('model' => $model)); ?>
</div>
<div style="display: none;text-align: center;" id="ajaxLoad" data-loading>
    <img style="position:relative;top:68px" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'ajax.gif'); ?>" />
</div>
<div class="col-lg-6">
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo Yii::app()->name ?></h4>
                </div>
                <div class="modal-body" id="modalText">
                    Вибачте, але на сайті виникла помилка.<br>
                    Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ок</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'spoilerPay.css'); ?>"/>

<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery-ui.min.js'); ?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/metisMenu/dist/metisMenu.min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/raphael/raphael-min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'dist/js/sb-admin-2.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_teacher.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_trainer/trainer.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/morrisjs/morris.min.js');?>"></script>

<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.11/sorting/date-de.js"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>
<?php if(Yii::app()->user->model->isContentManager()){?>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'cabinet/contentManager.js'); ?>"></script>
<?php }?>
<?php if(Yii::app()->user->model->isAccountant()){?>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', '_accountancy/agreement.js'); ?>"></script>
<?php } ?>
<?php if(Yii::app()->user->model->isAdmin()){?>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/graduatesList.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/configList.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/responsesList.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/translatesList.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/aboutUsSliderList.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/mainSliderList.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/teachersList.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/shareLinks.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/usersManage.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/freeLectures.js'); ?>"></script>
<?php } ?>
<!--Typeahead  scripts -->
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'handlebars.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'typeahead.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'pay.js'); ?>"></script>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/tmanage.js'); ?>"></script>

<!--Deprecated  scripts
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/verifyContent.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/modulesList.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/coursesList.js'); ?>"></script>
-->

<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/requestsList.js'); ?>"></script>