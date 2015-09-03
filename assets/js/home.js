var options = 	{
					chart: {
						renderTo: 'container',
						type: 'column'
					},
					credits: {
			      		enabled: false
				  	},
			        title: {
			            text: 'Daily Expenses',
			            x: -20 //center
			        },
			        plotOptions:{
			        	line:{
			        		connectNulls:true
			        	},
			        	column:{
			        		dataLabels:{
			        			enabled:true,
			        			//color: '#FFFFFF',
				                align: 'center',
				                //format: '{point.y:.1f}', // one decimal
				                //y: 10, // 10 pixels down from the top
				                // style: {
				                //     fontSize: '13px',
				                //     fontFamily: 'Verdana, sans-serif'
				                // }
			        		}
			        	}
			        },
			        // subtitle: {
			        //     text: 'Source: WorldClimate.com',
			        //     x: -20
			        // },
			        xAxis: {
			            categories: [{}]
			        },
			        yAxis: {
			            title: {
			                text: 'Temperature (°C)'
			            },
			            plotLines: [{
			                value: 0,
			                width: 1,
			                color: '#808080'
			            }],
			            //tickInterval: 3,
			            //min:0
			        },
			        // tooltip: {
			        //     valueSuffix: '°C'
			        // },
			        legend: {
			            layout: 'vertical',
			            align: 'right',
			            verticalAlign: 'middle',
			            borderWidth: 0
			        },
			        series: []
			    }

var chart;
var get_graph = function(){
	$.ajax({
		url: "graph/hourlyexpenses",
		type:'post',
		dataType: "json",
		success: function(data){
			options.series=[];
			var name,x,i=0;
			$.each(data.series, function(index, element) {
	            var seriesOptions = {
				            name: element.name,
				            data: element.data
				        };

			            options.series.push(seriesOptions);
	        });

			options.xAxis.categories = data.categories;

		 	chart = new Highcharts.Chart(options);	

		 	// chart.series[0].update({
	   //          type: 'line'
	   //      });		
		}
	});
}
$(document).ready(function() { 
		get_graph();
		
});