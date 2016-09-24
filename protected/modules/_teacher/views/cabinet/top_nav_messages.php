    <li ng-repeat="message in messages.newMessages">
        <a class="newMessages" ng-href="#/dialog/{{message.senderId}}/{{message.userId}}">
            <div>
                <strong>{{message.user}}</strong>
                <span class="pull-right text-muted">
                    <em>{{message.date}}</em>
                </span>
            </div>
            <div>{{message.subject}}</div>
        </a>
    </li>

<li>
    <a class="text-center" href="#">
        <strong>
            <a ng-href="#/messages">
                Всі повідомлення
            </a>
        </strong>
        <i class="fa fa-angle-right"></i>
    </a>
</li>