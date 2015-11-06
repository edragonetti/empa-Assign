<h1>Sessions</h1>
<div>
<table class="table" st-pipe="sg.callServer" st-table="sg.displayed">
	<thead>
	<tr>
		<th st-sort="created_at">Date</th>
		<th st-sort="sessionid">Session Id</th>
		<th st-sort="deviceid">Device Id</th>
		<th st-sort="username">Username</th>
		<th st-sort="lastname">Last Name</th>
		<th st-sort="elapsed">Duration</th>
		<th>Actions</th>
	</tr>
	<!--tr>
		<th></th>
		<th><input st-search="sessionid"/></th>
		<th><input st-search="deviceid"/></th>
		<th><input st-search="username"/></th>
		<th><input st-search="lastname"/></th>
		<th></th>
		<th></th>
	</tr-->
	</thead>
	<tbody ng-show="!sg.isLoading">
	<tr ng-repeat="row in sg.displayed">
		<td>{{row.created_at}}</td>
		<td>{{row.sessionid}}</td>
		<td>{{row.deviceid}}</td>
		<td>{{row.username}}</td>
		<td>{{row.lastname}}</td>
		<td>{{row.elapsed}}</td>
		<td>
			<a href="#viewSession/{{row.id}}" class="btn btn-primary">
			<i class="icon-white icon-search"></i> View Session
			</a>
		</td>
	</tr>
	</tbody>
	<tbody ng-show="sg.isLoading">
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