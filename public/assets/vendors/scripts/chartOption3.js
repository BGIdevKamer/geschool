
var options4 = {
    series: percentageTable,
    chart: {
        height: 350,
        type: 'radialBar',
    },
    colors: ['#003049', '#d62828', '#f77f00', '#fcbf49', '#e76f51'],
    plotOptions: {
        radialBar: {
            dataLabels: {
                name: {
                    fontSize: '22px',
                },
                value: {
                    fontSize: '16px',
                },
                total: {
                    show: true,
                    label: 'Total',
                    formatter: function (w) {
                        return parseInt(percentageTable[0]) + parseInt(percentageTable[1])
                    }
                }
            }
        }
    },
    labels: ['F', 'H'],
};

var chart4 = new ApexCharts(document.querySelector("#diseases-chart"), options4);
chart4.render();
