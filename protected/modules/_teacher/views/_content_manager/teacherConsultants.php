<div class="ng-scope ng-isolate-scope alert alert-dismissible alert-success">
    *Викладач - співробітник, за яким закріплені деякі студенти і деякі модулі. Студента до викладача закріплює його тренер.
    При умові, коли студент має доступ до модуля і за студентом закріплений викладач, за яким закріплений цей самий модуль -
    викладач може перевіряти і оцінювати 'прості задачі', на які дав відповідь студент.
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <ul id="accessTabs" class="nav nav-tabs">
            <li class="active"><a href="#all" data-toggle="tab">Викладачі</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="all">
                <?php $this->renderPartial('/_content_manager/_allTeacherConsultants');?>
            </div>
        </div>
    </div>
</div>