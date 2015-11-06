dashboard.controller('ChartCtrl',['ChartDataService','Highstock','$scope', function(service,highstock,$scope) {
	   

	$(function () {

	   
	    $('#container').bind('mousemove touchmove', function (e) {
	        var chart,
	            point,
	            i;

	        for (i = 0; i < Highcharts.charts.length; i = i + 1) {
	            chart = Highcharts.charts[i];
	            e = chart.pointer.normalize(e); // Find coordinates within the chart
	            point = chart.series[0].searchPoint(e, true); // Get the hovered point

	            if (point) {
	                point.onMouseOver(); // Show the hover marker
	                chart.tooltip.refresh(point); // Show the tooltip
	                chart.xAxis[0].drawCrosshair(e, point); // Show the crosshair
	            }
	        }
	    });
	    /**
	     * Override the reset function, we don't need to hide the tooltips and crosshairs.
	     */
	    Highcharts.Pointer.prototype.reset = function () {
	        return undefined;
	    };

	    /**
	     * Synchronize zooming through the setExtremes event handler.
	     */
	    function syncExtremes(e) {
	        var thisChart = this.chart;

	        Highcharts.each(Highcharts.charts, function (chart) {
	            if (chart !== thisChart) {
	                if (chart.xAxis[0].setExtremes) { // It is null while updating
	                    chart.xAxis[0].setExtremes(e.min, e.max);
	                }
	            }
	        });
	    }
	    
	    highstock.makeChart('api/getEda', null,syncExtremes,'#edaChart',"Eda","Eda",' μS','{value} μS',"#6bafc1");

	    highstock.makeChart('api/getHr', null,syncExtremes,'#hrChart',"Hr","HR",' BPM','{value} BPM',"#db843d");
	    
	    highstock.makeChart('api/getTemp', null,syncExtremes,'#tempChart',"Temperature","Temperature",' C','{value} °C',"#89a54e");
	    
	    highstock.makeChart('api/getAcc', null,syncExtremes,'#accChart',"Accelerometers","Accelerometers",' g','{value} g',"#80699b");
	    
	    
	   
	});

}]);