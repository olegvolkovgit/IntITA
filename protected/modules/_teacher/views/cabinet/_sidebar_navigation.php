<?php
/* @var $model Teacher */
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
                <!-- /input-group -->
            </li>
            <li>
                <a href="#" onclick="loadPage('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
                    array('page' => 'dashboard'));?>', '<?php echo "_dashboard";?>')"><i class="fa fa-dashboard fa-fw"></i> Дошка</a>
            </li>

            <?php
            $roles = $model->roles();
            foreach($roles as $role){
                ?>
                <li>
                    <a href="#" onclick="loadPage('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
                        array('page' => $role->title_en));?>', '<?php echo "_".$role->title_en;?>')">
                        <i class="fa fa-table fa-fw"></i> <?php echo $role->title_ua?></a>
                </li>
            <?php
            }
            ?>
<!--
            <li>
                <a href="#" onclick="loadPage('<?php //echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
                    //array('page' => 'trainer'));?>', '_trainer')">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Тренер<span class="fa arrow"></span></a>
                <!--                        <ul class="nav nav-second-level">-->
                <!--                            <li>-->
                <!--                                <a href="pages/flot.html">Flot Charts</a>-->
                <!--                            </li>-->
                <!--                            <li>-->
                <!--                                <a href="pages/morris.html">Morris.js Charts</a>-->
                <!--                            </li>-->
                <!--                        </ul>-->
                <!-- /.nav-second-level
            </li>
            <li>
                <a href="#" onclick="loadPage('<?php //echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
                   // array('page' => 'consultant'));?>', '_consultant')">
                    <i class="fa fa-table fa-fw"></i> Консультант</a>
            </li>
            <li>
                <a href="#" onclick="loadPage('<?php //echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
                    //('page' => 'leader'));?>' , '_leader')">
                    <i class="fa fa-edit fa-fw"></i> Керівник проекта</a>
            </li>
            <li>
                <a href="#" onclick="loadPage('<?php //echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
                   // array('page' => 'moduleList'));?>', '_author')">
                    <i class="fa fa-wrench fa-fw"></i> Автор модуля</a>
                <!--                        <span class="fa arrow"></span>-->
                <!--  <ul class="nav nav-second-level">
                      <li>
                          <a href="pages/panels-wells.html">Panels and Wells</a>
                      </li>
                      <li>
                          <a href="pages/buttons.html">Buttons</a>
                      </li>
                      <li>
                          <a href="pages/notifications.html">Notifications</a>
                      </li>
                      <li>
                          <a href="pages/typography.html">Typography</a>
                      </li>
                      <li>
                          <a href="pages/icons.html"> Icons</a>
                      </li>
                      <li>
                          <a href="pages/grid.html">Grid</a>
                      </li>
                  </ul>
                  <!-- /.nav-second-level
              </li>
              <li>
                  <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                      <li>
                          <a href="#">Second Level Item</a>
                      </li>
                      <li>
                          <a href="#">Second Level Item</a>
                      </li>
                      <li>
                          <a href="#">Third Level <span class="fa arrow"></span></a>
                          <ul class="nav nav-third-level">
                              <li>
                                  <a href="#">Third Level Item</a>
                              </li>
                              <li>
                                  <a href="#">Third Level Item</a>
                              </li>
                              <li>
                                  <a href="#">Third Level Item</a>
                              </li>
                              <li>
                                  <a href="#">Third Level Item</a>
                              </li>
                          </ul>
                          <!-- /.nav-third-level
                      </li>
                  </ul>
                  <!-- /.nav-second-level-->
            <!--</li>
            <!--                    <li>-->
            <!--                        <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>-->
            <!--                        <ul class="nav nav-second-level">-->
            <!--                            <li>-->
            <!--                                <a href="pages/blank.html">Blank Page</a>-->
            <!--                            </li>-->
            <!--                            <li>-->
            <!--                                <a href="pages/login.html">Login Page</a>-->
            <!--                            </li>-->
            <!--                        </ul>-->
            <!--                        <!-- /.nav-second-level -->
            <!--                    </li>-->
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->