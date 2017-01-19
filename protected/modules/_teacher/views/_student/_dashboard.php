<div class="row">
    <div class="col-lg-12">
        Студент
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                &nbsp;
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#/students/courses">Доступні курси/модулі</a>
                    </li>
                    <li><a href="#/students/consultations">Консультації</a>
                    </li>
                    <li><a href="#/students/finances">Фінанси</a>
                    </li>
                    <?php if(UserStudent::studentHasSubgroup(Yii::app()->user->getId())) { ?>
                    <li>
                        <a href="#/students/offlineEducation">
                            Офлайн навчання
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="panel-footer">
                &nbsp;
            </div>
        </div>
    </div>
</div>