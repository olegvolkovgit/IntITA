<div class="panel panel-default">
    <div class="panel-body">

        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#all" data-toggle="tab">Всі модулі</a>
            </li>
            <li><a href="#all" data-toggle="tab">Без відео</a>
            </li>
            <li><a href="#all" data-toggle="tab">Без тестів</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="all">
                
                <?php $this->renderPartial('/_content_manager/_allModules', array('id' => $id));?>
            </div>
        </div>
    </div>
</div>