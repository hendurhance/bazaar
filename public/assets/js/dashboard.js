// Create a new chart instance for the user chart
function createUserBarChart(ctx, labels, data) {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                barPercentage: 0.1,
                barThickness: 6,
                barGap: 0,
                maxBarThickness: 8,
                minBarLength: 2,
                label: 'Total Users',
                data: data,
                backgroundColor: [
                    'rgba(5, 195, 251, 0.2)',
                    'rgba(5, 195, 251, 0.2)',
                    '#05c3fb',
                    'rgba(5, 195, 251, 0.2)',
                    'rgba(5, 195, 251, 0.2)',
                    '#05c3fb',
                    '#05c3fb'
                ],
                borderColor: [
                    'rgba(5, 195, 251, 0.5)',
                    'rgba(5, 195, 251, 0.5)',
                    '#05c3fb',
                    'rgba(5, 195, 251, 0.5)',
                    'rgba(5, 195, 251, 0.5)',
                    '#05c3fb',
                    '#05c3fb'
                ],
                pointBorderWidth: 2,
                pointRadius: 2,
                pointHoverRadius: 2,
                borderRadius: 10,
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                tooltip: {
                    enabled: true
                }
            },
            responsive: true,
            scales: {
                x: {
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                    barRadius: 0,
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                },
                y: {
                    display: false,
                    ticks: {
                        display: false,
                    }
                }
            },
            title: {
                display: false,
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });
}

// Create a new chart instance for the ads chart
function createAdsLineChart(ctx, labels, data) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Ads',
                data: data,
                backgroundColor: 'transparent',
                borderColor: '#f46ef4',
                borderWidth: '2.5',
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'transparent',
                lineTension: 0.3
            },]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                tooltip: {
                    enabled: true
                }
            },
            responsive: true,
            scales: {
                x: {
                    ticks: {
                        beginAtZero: true,
                        fontSize: 10,
                        fontColor: "transparent",
                    },
                    title: {
                        display: false,
                    },
                    grid: {
                        display: true,
                        color: 'transparent																																					',
                        drawBorder: false,
                    },
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                },
                y: {
                    display: false,
                    ticks: {
                        display: false,
                    }
                }
            },
            title: {
                display: false,
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });
}

// Create a new chart instance for the ads chart
function createBidsBarChart(ctx, labels, data) {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                barPercentage: 0.1,
                barThickness: 6,
                maxBarThickness: 8,
                minBarLength: 2,
                label: 'Total Bids',
                barGap: 0,
                barSizeRatio: 1,
                data: data,
                backgroundColor: '#4ecc48',
                borderColor: '#4ecc48',
                pointBackgroundColor: '#fff',
                pointHoverBackgroundColor: '#4ecc48',
                pointBorderColor: '#4ecc48',
                pointHoverBorderColor: '#4ecc48',
                pointBorderWidth: 2,
                pointRadius: 2,
                pointHoverRadius: 2,
                borderRadius: 10,
                borderWidth: 1
            },]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                tooltip: {
                    enabled: true
                }
            },
            responsive: true,
            scales: {
                x: {
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                },
                y: {
                    display: false,
                    ticks: {
                        display: false,
                    }
                }
            },
            title: {
                display: false,
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });
}

// Create a new chart instance for the transaction chart
function createTransactionsLineChart(ctx, labels, data) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Transaction',
                data: data,
                backgroundColor: 'transparent',
                borderColor: '#f7ba48',
                borderWidth: '2.5',
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'transparent',
                lineTension: 0.3
            },]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                tooltip: {
                    enabled: true
                }
            },
            responsive: true,
            scales: {
                x: {
                    categoryPercentage: 1.0,
                    barPercentage: 1.0,
                    barDatasetSpacing: 0,
                    display: false,
                    barThickness: 5,
                    gridLines: {
                        color: 'transparent',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        fontSize: 2,
                        fontColor: 'transparent'
                    }
                },
                y: {
                    display: false,
                    ticks: {
                        display: false,
                    }
                }
            },
            title: {
                display: false,
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        }
    });
}

// Create a new chart instance for the ads vs bids
function createTransactionChart(labels, data1, data2) {
    var myCanvas = document.getElementById("bids-ads");
    myCanvas.height = "330";
    var myCanvasContext = myCanvas.getContext("2d");
    var gradientStroke1 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
    gradientStroke1.addColorStop(0, 'rgba(108, 95, 252, 0.8)');
    gradientStroke1.addColorStop(1, 'rgba(108, 95, 252, 0.2) ');

    var gradientStroke2 = myCanvasContext.createLinearGradient(0, 80, 0, 280);
    gradientStroke2.addColorStop(0, 'rgba(5, 195, 251, 0.8)');
    gradientStroke2.addColorStop(1, 'rgba(5, 195, 251, 0.2) ');
    document.getElementById('bids-ads').innerHTML = '';
    var myChart;
    myChart = new Chart(myCanvas, {

        type: 'line',
        data: {
            labels: labels,
            type: 'line',
            datasets: [{
                label: 'Total Bids',
                data: data1,
                backgroundColor: gradientStroke1,
                borderColor: "#05c3fb",
                pointBackgroundColor: '#fff',
                pointHoverBackgroundColor: gradientStroke1,
                pointBorderColor: "#05c3fb",
                pointHoverBorderColor: gradientStroke1,
                pointBorderWidth: 0,
                pointRadius: 0,
                pointHoverRadius: 0,
                borderWidth: 3,
                fill: 'origin',
                lineTension: 0.3
            }, {
                label: 'Total Ads',
                data: data2,
                backgroundColor: 'transparent',
                borderColor: "#05c3fb",
                pointBackgroundColor: '#fff',
                pointHoverBackgroundColor: gradientStroke2,
                pointBorderColor: "#05c3fb",
                pointHoverBorderColor: gradientStroke2,
                pointBorderWidth: 0,
                pointRadius: 0,
                pointHoverRadius: 0,
                borderWidth: 3,
                fill: 'origin',
                lineTension: 0.3

            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        usePointStyle: false,
                    }
                },
                tooltip: {
                    enabled: true
                }
            },
            scales: {
                x: {
                    display: true,
                    grid: {
                        display: false,
                        drawBorder: false,
                        color: 'rgba(119, 119, 142, 0.08)'
                    },
                    ticks: {
                        autoSkip: true,
                        color: '#b0bac9'
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month',
                        fontColor: 'transparent'
                    }
                },
                y: {
                    ticks: {
                        min: 0,
                        max: 1050,
                        stepSize: 150,
                        color: "#b0bac9",
                    },
                    display: true,
                    grid: {
                        display: true,
                        drawBorder: false,
                        zeroLineColor: 'rgba(142, 156, 173,0.1)',
                        color: "rgba(142, 156, 173,0.1)",
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'sales',
                        fontColor: 'transparent'
                    }
                }
            },
            title: {
                display: false,
                text: 'Normal Legend'
            }
        }
    });
}


// Create payment bar chart
function createPaymentsBarChart(ctx, labels, data) {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Sales',
                data: data,
                borderWidth: 2,
                backgroundColor: '#6c5ffc',
                borderColor: '#6c5ffc',
                borderWidth: 2.0,
                pointBackgroundColor: '#ffffff',

            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true
            },
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true,
                        stepSize: 150,
                        color: "#9ba6b5",
                    },
                    grid: {
                        color: 'rgba(119, 119, 142, 0.2)'
                    }
                },
                x: {
                    barPercentage: 0.4,
                    barValueSpacing: 0,
                    barDatasetSpacing: 0,
                    barRadius: 0,
                    ticks: {
                        display: true,
                        color: "#9ba6b5",
                    },
                    grid: {
                        display: false,
                        color: 'rgba(119, 119, 142, 0.2)'
                    }
                }
            },
            legend: {
                labels: {
                    fontColor: "#9ba6b5"
                },
            },
        }
    });
}

// Create a new chart instance for location chart
function createLocationChart(ctx, labels, data) {
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: ['#6c5ffc', '#05c3fb', '#09ad95', '#1170e4', '#e82646', '#f7ba48', '#4ecc48', '#f46ef4', '#eee333', '#f7ba48'],
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
}