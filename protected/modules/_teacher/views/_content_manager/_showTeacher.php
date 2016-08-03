<?php
/**
 * @var $user RegisteredUser
 */
$teacher = $user->getTeacher();
?>
<div class="panel panel-default">
    <div class="panel-body">
        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#main" data-toggle="tab">Головне</a>
            </li>
            <?php if ($user->isAuthor()) { ?>
                <li><a href="#author" data-toggle="tab">Автор</a>
                </li>
            <?php } ?>
            <?php if ($user->isConsultant()) { ?>
                <li><a href="#consultant" data-toggle="tab">Консультант</a>
                </li>
            <?php } ?>
            <?php if ($user->isTeacherConsultant()) { ?>
                <li><a href="#teacher_consultant" data-toggle="tab">Викладач</a>
                </li>
            <?php } ?>
        </ul>
        <div class="panel-body">
            <?php if (Yii::app()->user->model->isAdmin()) { ?>
                <ul class="list-inline">
                    <li>
                        <button type="button" class="btn btn-primary"
                                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/users/index'); ?>',
                                    'Користувачі')">Користувачі
                        </button>
                    </li>
                </ul>
            <?php } ?>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="main">
                <?php $this->renderPartial('/_content_manager/_mainTeacherTab', array('user' =>$user));?>
            </div>
            <?php if ($user->isAuthor()) { ?>
                <div class="tab-pane fade" id="author">
                    <?php $this->renderPartial('/_content_manager/_authorTab', array('user' =>$user));?>
                </div>
            <?php } ?>
            <?php if ($user->isConsultant()) { ?>
                <div class="tab-pane fade" id="consultant">
                    <?php $this->renderPartial('/_content_manager/_consultantTab', array('user' =>$user));?>
                </div>
            <?php } ?>
            <?php if ($user->isTeacherConsultant()) { ?>
                <div class="tab-pane fade" id="teacher_consultant">
                    <?php $this->renderPartial('/_content_manager/_teacherConsultantTab', array('user' =>$user));?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    if(history.state!=null){
        openTabByHref('#accessTabs', history.state.tab);
    }
</script>