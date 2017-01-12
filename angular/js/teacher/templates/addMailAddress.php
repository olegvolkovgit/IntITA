<div class="panel panel-default" ng-controller="mailTemplatesCtrl">
    <script>
        var domain = window.location.hostname.split('www.');
        if (domain.length>1)
        {
            domain = domain[1];
        }
        document.getElementById("domain").innerHTML = '@'+domain;
    </script>
    <div class="panel-body" >
        <div class="col-xs-6">
            <input class="form-control" id="ex1" type="text">
        </div>
        <div id="domain" style="font-size:14pt; margin-right: -12px;">

        </div>
    </div>
</div>