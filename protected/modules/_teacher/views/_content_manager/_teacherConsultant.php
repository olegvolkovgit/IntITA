<?php
/**
 * @var $user RegisteredUser
 */
?>
<div class="panel panel-default">
    <div class="panel-body">
        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#main" data-toggle="tab">Головне</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="main">
                <?php $this->renderPartial('/_content_manager/_mainTeacherTab', array('user' =>$user));?>
            </div>
        </div>
    </div>
</div>