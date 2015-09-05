var options = {
        chart: {
            renderTo: 'container',
            type: 'column'
        },
        credits: {
                        enabled: false
                    },
        title: {
            text: 'Daily Expenses'
        },
        // xAxis: {
        //     categories: []
        // },
        xAxis:[],
        yAxis: {
            min: 0,
            title: {
                text: 'Amount'
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
            x: 0,
            verticalAlign: 'top',
            y: 0,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            // formatter: function () {
            //     return '<b>' + this.x + '</b><br/>' +
            //         this.series.name + ': ' + this.y + '<br/>' +
            //         'Total: ' + this.point.stackTotal;
            // }
            shared:true
        },
        plotOptions: {
            column: {
                // pointPadding: 0,
                // borderWidth: 0,
                //pointWidth:50,
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
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
var get_graph1 = function(){
    $.ajax({
        //url: "graph/dailyexpenses",
        url: "graph/dailysummary",
        type:'post',
        dataType: "json",
        success: function(data){
            options.series= data.series;
            options.chart.renderTo = 'container';
            options.xAxis.push({categories:data.categories});
            //alert(data.weekdays);
            options.xAxis.push({opposite:true,categories:data.weekdays});
            chart = new Highcharts.Chart(options,function(chart) {
                var extremes = chart.xAxis[0].getExtremes();
                chart.xAxis[1].setExtremes(extremes.min-0.5,extremes.max+0.5);
                });      
        }
    });
}

$(document).ready(function() { 
        get_graph1();
        //get_graph2();

        $('.chartbutton').click(function(){
            var url='/graph/'+$(this).data('url');
            $.ajax({
                //url: "graph/dailyexpenses",
                url: url,
                type:'post',
                dataType: "json",
                success: function(data){
                    while(chart.series.length > 0){
                        chart.series[0].remove(true);
                    }
                    chart.colorCounter = 0;
                    chart.symbolCounter = 0;
                    
                    $.each(data.series, function(index, element) {
                        chart.addSeries(element,false);              
                    });
                    chart.xAxis[0].setCategories(data.categories);
                    //chart.redraw();     
                }
            });
                
        });
        
});