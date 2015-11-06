<h1>Devices</h1>
<div>
<table class="table table-striped" st-pipe="dg.callServer" st-table="dg.displayed">
	<thead>
	<tr>
		<th st-sort="deviceid">Device Id</th>
		<th st-sort="status">Status</th>
		<th st-sort="username">Username</th>
		<th st-sort="lastname">Last Name</th>
		<th st-sort="name">Name</th>
		<th>Created</th>
		<th>Actions</th>
	</tr>
	<!--
		<th><input st-search="deviceid"/></th>
		<th><input st-search="status"/></th>
		<th><input st-search="username"/></th>
		<th><input st-search="lastname"/></th>
		<th><input st-search="name"/></th>
		<th></th>
		<th></th>
	</tr-->
	</thead>
	<tbody ng-show="!dg.isLoading">
	<tr ng-repeat="row in dg.displayed">
		<td>{{row.deviceid}}</td>
		<td>{{row.status}}</td>
		<td>{{row.username}}</td>
		<td>{{row.lastname}}</td>
		<td>{{row.name}}</td>
		<td>{{row.created_at}}</td>
		<td>
			<a href="#showSessionsFrom/d/{{row.id}}" class="btn btn-primary">
			<i class="icon-white icon-search"></i> View Session
			</a>
		</td>
	</tr>
	</tbody>
	<tbody ng-show="dg.isLoading">
	<tr>
		<td colspan="7" class="text-center">
			<div class="timer-loader">
  			Loading…
			</div>
		</td>
	</tr>
	</tbody>
	<tfoot>
	<tr>
		<td class="text-center" st-pagination="" st-items-by-page="20" colspan="5">
		</td>
	</tr>
	</tfoot>
</table>	
</div>