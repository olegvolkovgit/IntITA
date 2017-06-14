<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Проплачені курси:</h4>
                <ul ng-if="studentAttributes.courses.length!=0" class="list-group">
                    <li ng-repeat="course in studentAttributes.courses track by $index" class="list-group-item">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="" data-toggle="collapse" ng-click="collapse('#collapse'+course.id)">
                                            {{course.title_ua}} ({{course.lang}}, {{course.name}})
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{course.id}}" class="panel-collapse collapse">
                                    <ul>
                                        <li ng-repeat="module in course.modules track by $index">
                                            <a href={{module.link}} target="_blank">
                                                {{module.title}} ({{module.lang}})
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <em ng-if="studentAttributes.courses.length==0">Курсів немає.</em>
            </div>
        </div>
    </div>
</div>