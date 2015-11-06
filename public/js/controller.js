dashboard.controller('HomeController',[function(){
	
	
}]);
		
dashboard.controller('userGridCtrl', ['GridDataService', function (service) {

	  var ctrl = this;
	  
	  this.displayed = [];

	  this.callServer = function callServer(tableState) {

		ctrl.isLoading = true;

	    var pagination = tableState.pagination;

	    var start = pagination.start || 0;     
	    var number = pagination.number || 10;  

	    service.getData('api/getUsers',start, number, tableState).then(function (result) {
	      ctrl.displayed = result.data;
	      tableState.pagination.numberOfPages = result.numberOfPages;//set the number of pages so the pagination can update
	      ctrl.isLoading = false;
	    });
	  };

}]);

dashboard.controller('deviceGridCtrl', ['GridDataService', function (service) {

	  var ctrl = this;
	  
	  this.displayed = [];

	  this.callServer = function callServer(tableState) {

		ctrl.isLoading = true;

	    var pagination = tableState.pagination;

	    var start = pagination.start || 0;    
	    var number = pagination.number || 10;  

	    service.getData('api/getDevices',start, number, tableState).then(function (result) {
	      ctrl.displayed = result.data;
	      tableState.pagination.numberOfPages = result.numberOfPages;//set the number of pages so the pagination can update
	      ctrl.isLoading = false;
	    });
	  };

}]);
	
dashboard.controller('sessionGridCtrl', ['GridDataService','$routeParams', function (service,$routeParams) {

	  var ctrl = this;
	  
	  var from=null;
	  var id=null;
	  
	  if (typeof $routeParams.from != "undefined" && typeof $routeParams.id !="undefined")
	  {
		  from=$routeParams.from;
		  id=$routeParams.id;
	  }
	  this.displayed = [];

	  this.callServer = function callServer(tableState) {

		ctrl.isLoading = true;

	    var pagination = tableState.pagination;

	    var start = pagination.start || 0;     
	    var number = pagination.number || 10; 

	    if (from!=null && id!=null)
	    {
	    	
	    	if (from=="d")
	    		tableState.deviceid=id;
	    	else
	    		tableState.userid=id;
	    	
	    }
	    
	    service.getData('api/getSessions',start, number, tableState).then(function (result) {
	      ctrl.displayed = result.data;
	      tableState.pagination.numberOfPages = result.numberOfPages;//set the number of pages so the pagination can update
	      ctrl.isLoading = false;
	    });
	  };

}]);
	