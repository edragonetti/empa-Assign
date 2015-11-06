dashboard.service('GridDataService', ['$q','$http', 
                              function ($q, $http){
	   this.getData = function (url,start, number, params) {

		   var deferred = $q.defer();

		   $http.post(url,params).success( function(response) {
			   deferred.resolve({
					data: response,
					numberOfPages: 1
				}); 
		   }).error(function(data, status, header, config) {
			    alert("qui");
		   });;
			
			

			return deferred.promise;
		}
}]);


dashboard.service('ChartDataService', ['$q','$http', 
                                      function ($q, $http){
        	   this.getData = function (url,params) {

        		   var deferred = $q.defer();

        		   $http.post(url,params).success( function(response) {
        			   deferred.resolve({
        					data: response
        				}); 
        		   });
        			
        			

        			return deferred.promise;
        		}
}]);


dashboard.service('Highstock', ['ChartDataService',function (service){
         	   this.makeChart = function (url,params,syncExtremes,container,name,title,
         			   valueSuffix,format,color) {

         		  service.getData(url, params).then(function (result) {

         		    	var cData=new Array();
         			  
         		    	var freq=null;
         		    	var $eventAt=null;
         		    	var pInterval=1;
         		    	
         		    	$eventAt=result.data.s;
         		    	freq=parseFloat(result.data.f);
         		    	pInterval=1000/freq;
         		    	
         		    	
         		    	
         		    		
         		    		result.data.d.forEach(function(row) {
     					    
         		    			cData.push({x:new Date($eventAt),y:parseFloat(row)});
         		    			$eventAt=$eventAt+pInterval;
         		    		});
         		    	
         		    	
         				  $(container).highcharts({
         	                 chart: {
         	                     marginLeft: 40, // Keep all charts left aligned
         	                     spacingTop: 20,
         	                     spacingBottom: 20,
         	                     //zoomType: 'x',
         	                     type:"spline"
         	                    
         	                 },
         	                 title: {
         	                     text: title,
         	                     align: 'left',
         	                     margin: 0,
         	                     x: 30
         	                 },
         	                 credits: {
         	                     enabled: false
         	                 },
         	                 legend: {
         	                     enabled: false
         	                 },
         	                 xAxis: {
         	                     crosshair: true,
         	                     events: {
         	                         setExtremes: syncExtremes
         	                     },
         	                     type: 'datetime'
         	                    
         	                 },
         	                 yAxis: {
         	                	 labels: {
         	                         format: format,
         	                         style: {
         	                             color: Highcharts.getOptions().colors[1]
         	                         }
         	                     }
         	                 },
         	                 tooltip: {
         	                     positioner: function () {
         	                         return {
         	                             x: this.chart.chartWidth - this.label.width, // right aligned
         	                             y: -1 // align to title
         	                         };
         	                     },
         	                     borderWidth: 0,
         	                     backgroundColor: 'none',
         	                     pointFormat: '{point.y}',
         	                     headerFormat: '',
         	                     shadow: false,
         	                     style: {
         	                         fontSize: '18px'
         	                     },
         	                     valueDecimals: 1
         	                 },
         	                 series: [{
         	                     //data: result.data,
         	                	pointInterval : pInterval,
         	                	data:cData,
         	                     name: name,
         	                     turboThreshold:0,
         	                     color: color,
         	                     fillOpacity: 0.3,
         	                     tooltip: {
         	                         valueSuffix: valueSuffix
         	                     }
         	                 }]
         	             });
         			  
         		    });
         		}
 }]);



