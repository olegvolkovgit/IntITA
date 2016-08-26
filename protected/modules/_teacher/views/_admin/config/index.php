<div class="col-md-12" ng-controller="siteConfigCtrl">

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body" >
                <div class="dataTable_wrapper">
                    <table ng-table="tableParams"  class="table table-striped table-bordered table-hover" style="table-layout: fixed">
                        <colgroup>
                            <col width="8%"/>
                        </colgroup>
                        <tr ng-repeat="row in $data">
                            <td data-title="'ID'" style="width: ">{{row.id}}</td>
                            <td data-title="'Параметр'" ><a href="#/configuration/siteconfig/view/{{row.id}}">{{row.param}}</a></td>
                            <td data-title="'Значення'">{{row.value}}</td>
                            <td data-title="'Опис'">{{row.label}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/ng-template" id="customHeader.html">
        <form name="demo.searchForm" class="pull-right" novalidate ng-submit="demo.applyGlobalSearch()">
            <div class="input-group">
            <span class="input-group-addon">Except for...
                <input type="checkbox" name="inverted" ng-model="demo.isInvertedSearch" />
              </span>
                <input type="text" class="form-control" placeholder="Search term" name="searchTerm" ng-model="demo.globalSearchTerm" />
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit" ng-disabled="demo.searchForm.$invalid">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
            </div>
        </form>
    </script>

</div>



