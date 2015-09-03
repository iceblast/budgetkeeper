var options = {
        chart: {
            renderTo: 'container',
            type: 'column'
        },
        credits: {
                        enabled: false
                    },
        title: {
            text: 'Stacked column chart'
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Expenses'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: []
    };

var chart;
var get_graph = function(){
    $.ajax({
        url: "graph/dailyexpenses",
        type:'post',
        dataType: "json",
        success: function(data){
            options.series=[];

            $.each(data.series, function(index, element) {
                var seriesOptions = {
                            name: element.name,
                            data: element.data
                        };

                        options.series.push(seriesOptions);
            });
            options.xAxis.categories = data.categories;
            chart = new Highcharts.Chart(options);      
        }
    });
}
$(document).ready(function() { 
        get_graph();
        
});