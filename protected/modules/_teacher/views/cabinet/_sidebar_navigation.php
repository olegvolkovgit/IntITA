<?php
/* @var $model StudentReg */
?>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Пошук...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>
            <li id="nav">
                <a href="#"
                   ng-click='ngLoadDashboard("<?php echo Yii::app()->createUrl("/_teacher/cabinet/loadDashboard",
                       array('user' => $model->id)); ?>")'>
                    <i class="fa fa-dashboard fa-fw"></i> Дошка</a>
            </li>

            <?php
            $roles = Yii::app()->user->model->getRoles();
            foreach($roles as $role) {
                $view = '/' . $role . '/sidebar';
                $this->renderPartial($view, array(
                    'model' => $model
                ));
            }
            ?>
        </ul>
    </div>
</div>














