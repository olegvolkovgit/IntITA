<li ng-repeat="request in requests.newRequests ">
        <a class='requestList' href="#/requests/message/{{request.id}}">
            <div>
                    <strong>{{request.sender}}</strong>
                    <span class="pull-right text-muted"><em>{{request.title}}</em></span>
                    <div nf-if="request.module">Модуль: <em>{{request.module}}</em></div>
            </div>
        </a>
    </li>
    <li class="divider"></li>
<li>
    <a class="text-center" href="#">
        <strong><a href="#/requests" >
                Всі запити</a></strong>
        <i class="fa fa-angle-right"></i>
    </a>
</li>