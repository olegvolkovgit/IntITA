<?php
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/interpreterForm.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <title>Тест для задачі</title>
</head>
<body>
    <div class="container-fluid" ng-app="App">
        <h1 id="title">Тест для задачі</h1>
   <div id="firstForm">
       <br>
        <div class="row col" ng-controller="Ctrl">

                <div class="col-lg-2">
                    <input type="text" class="form-control" placeholder="Variable name">
                </div>
                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Primitive <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Array</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                    </ul>
                </div>

                <div class="col-lg-2">
                    <input type="hidden" name="size" class="form-control"   placeholder="Size">
                </div>

                <!-- Single button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Type <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                    </ul>
                </div>

                    <div class="col-lg-2">
                <input type="text" class="form-control" placeholder="Value"></div>

            <button id ="btn" type="button" class="btn btn-default pull-right btnInterp" ng-click="">
                <span class="glyphicon glyphicon glyphicon-plus " aria-hidden="true"></span>
            </button>
        </div>
   </div>
        <!--Div for add new clone -->
        <div id="forAppForms">
        </div>

        <hr>

        <div class="row col">
                <div class="col-lg-2">
                    <!-- Single button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Result <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <input type="text" class="form-control" placeholder="Type">
                </div>
                <div class="col-lg-2">
                    <input type="text" class="form-control" placeholder="Size">
                </div>
                <div class="col-lg-2">
                    <input type="text" class="form-control" placeholder="Value">
                </div>

        </div>

        <br>
        <div class="row">
            <button type="submit" class="btn btn-default pull-right btnInterp" ng-click="">Submit</button>
        </div>


    </div>
</body>
</html>

<script>
    $(document).ready(function() {
        count = 1;
        $("#btn").click(function () {
            var clone = $("#firstForm").clone();
            var el = $(clone).find('span.glyphicon.glyphicon.glyphicon-plus');
            el.removeClass('glyphicon-plus');
            el.addClass('glyphicon-minus');
            el.parent().attr('onclick','removeClone(this)');
            var num = 'firstForm' + count;
            count++;
            clone.prop({id: num}).appendTo("#forAppForms");
        });
    });
    function removeClone(el){
      $(el).parent().parent().remove();
    }

</script>