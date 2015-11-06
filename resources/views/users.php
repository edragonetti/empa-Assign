<h1>Users</h1>
<div>
<table class="table table-striped" st-pipe="ug.callServer" st-table="ug.displayed">
	<thead>
	<tr>
		<th st-sort="username">Username</th>
		<th st-sort="name">Name</th>
		<th st-sort="lastname">Lastname</th>
		<th st-sort="profile">Profile</th>
		<th>Created</th>
		<th>Actions</th>
	</tr>
	<!--tr>
		<th><input st-search="username"/></th>
		<th><input st-search="name"/></th>
		<th><input st-search="lastname"/></th>
		<th><input st-search="profile"/></th>
		<th></th>
		<th></th>
	</tr-->
	</thead>
	<tbody ng-show="!ug.isLoading">
	<tr ng-repeat="row in ug.displayed">
		<td>{{row.username}}</td>
		<td>{{row.name}}</td>
		<td>{{row.lastname}}</td>
		<td>{{row.profile}}</td>
		<td>{{row.created_at}}</td>
		<td>
			<a href="#showSessionsFrom/u/{{row.id}}" class="btn btn-primary">
			<i class="icon-white icon-search"></i> View Session
			</a>
		</td>
	</tr>
	</tbody>
	<tbody ng-show="ug.isLoading">
	<tr>
		<td colspan="6" class="text-center">
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