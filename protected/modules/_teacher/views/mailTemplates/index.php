<div class="col-md-12" ng-controller="mailTemplatesCtrl">
	<div class="col-lg-12">
		<div><button class="btn btn-primary" ng-click="changeView('newsletter/template/create')">Створити шаблон</button> </div>
		<br/>
		<div class="panel panel-default">
			<div class="panel-body" >
				<div class="dataTable_wrapper">
					<table ng-table="mailTemplatesTable"  class="table table-striped table-bordered table-hover" style="table-layout: fixed">
						<colgroup>
							<col width="8%"/>
						</colgroup>
						<tr ng-repeat="row in $data">
							<td data-title="'ID'" style="width: ">{{row.id}}</td>
							<td data-title="'Назва шаблону'">{{row.title}}</a></td>
							<td data-title="'Тема повідомлення'">{{row.subject}}</a></td>
							<td data-title="'Текст повідомлення'" style="text-overflow: ellipsis"><div ng-bind-html="row.text"></div></td>
							<td data-title="'Активний'"><span ng-show="row.active">Активний</span>
														<span ng-show="!row.active">Не активний</span></td>
							<td><span><button class="btn btn-info" ng-click="changeView('newsletter/template/view/'+row.id)"><i class="glyphicon glyphicon-eye-open"></i></button>
								<span><button class="btn btn-warning" ng-click="changeView('newsletter/template/edit/'+row.id)"><i class="glyphicon glyphicon-pencil"></i></button>
								<span><button class="btn btn-danger" ng-click="deleteTemplate(row.id)"><i class="glyphicon glyphicon-trash"></i></button>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
