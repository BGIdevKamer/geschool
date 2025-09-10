parseInt
// Configurer le graphique avec les données annuelles initiales
var options = {
    series: [{
        name: "Payement",
        data: amounts // Utiliser les montants extraits
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
        categories: years, // Utiliser les années extraites
        labels: {
            style: {
                colors: '#8c9094'
            }
        }
    },
    yaxis: {
        min: 0,
        max: Math.max(...amounts) + 10, // Définir un maximum dynamique
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

// Ajouter l'événement sur le bouton #mont pour afficher les données mensuelles
document.querySelector('#mont').addEventListener('click', function () {
    // Récupérer les données mensuelles
    let dataMont = getDataMont;

    // Extraire les mois et les montants mensuels
    let months = dataMont.map(item => `${item.year}-${item.month < 10 ? '0' + item.month : item.month}`); // Format année-mois
    let monthlyAmounts = dataMont.map(item => item.total); // Les montants mensuels

    // Mettre à jour le graphique avec les nouvelles données
    chart.updateOptions({
        series: [{
            name: "Payement",
            data: monthlyAmounts // Utiliser les montants mensuels
        }],
        xaxis: {
            categories: months, // Utiliser les mois formatés année-mois
        },
        yaxis: {
            min: 0,
            max: Math.max(...monthlyAmounts) + 10, // Ajuster le maximum dynamique
        }
    });
});

document.querySelector('#year').addEventListener('click', function () {

    // Mettre à jour le graphique avec les nouvelles données
    chart.updateOptions({
        series: [{
            name: "Payement",
            data: amounts // Utiliser les montants mensuels
        }],
        xaxis: {
            categories: years, // Utiliser les années extraites
        },
        yaxis: {
            min: 0,
            max: Math.max(...amounts) + 10, // Définir un maximum dynamique
        }
    });
});

