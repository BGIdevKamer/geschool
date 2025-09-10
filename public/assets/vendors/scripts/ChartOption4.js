// Configurer le graphique avec les données annuelles initiales
var options = {
    series: [{
        name: "Exercices",
        data: score // Utiliser les montants extraits
    }],
    chart: {
        height: 300,
        type: 'line',
        zoom: {
            enabled: false,
        },
        dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 16,
            opacity: 0.2
        },
        toolbar: {
            show: false
        }
    },
    colors: ['#f0746c', '#255cd3'],
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: [3, 3],
        curve: 'smooth'
    },
    grid: {
        show: false,
    },
    markers: {
        colors: ['#f0746c', '#255cd3'],
        size: 5,
        strokeColors: '#ffffff',
        strokeWidth: 2,
        hover: {
            sizeOffset: 2
        }
    },
    xaxis: {
        categories: exercice, // Utiliser les années extraites
        labels: {
            style: {
                colors: '#8c9094'
            }
        }
    },
    yaxis: {
        min: 0,
        max: Math.max(...score) + 10, // Définir un maximum dynamique
        labels: {
            style: {
                colors: '#8c9094'
            }
        }
    },
    legend: {
        position: 'top',
        horizontalAlign: 'right',
        floating: true,
        offsetY: 0,
        labels: {
            useSeriesColors: true
        },
        markers: {
            width: 10,
            height: 10,
        }
    }
};

// Initialiser le graphique
var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();