(function () {
    "use strict";

    /* basic pie chart */
    var options = {
        series: [44, 55, 13, 43, 22],
        chart: {
            height: 300,
            type: 'pie',
        },
        colors: ["#8e54e9", "#4876e6", "#f5b849", "#49b6f5", "#e6533c"],
        labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
        legend: {
            position: "bottom"
        },
        dataLabels: {
            dropShadow: {
                enabled: false
            }
        },
    };
    var chart = new ApexCharts(document.querySelector("#pie-basic"), options);
    chart.render();

    /* simple donut chart */
    var options = {
        series: [44, 55, 41, 17, 15],
        chart: {
            type: 'donut',
            height: 290
        },
        legend: {
            position: 'bottom'
        },
        colors: ["#8e54e9", "#4876e6", "#f5b849", "#49b6f5", "#e6533c"],
        dataLabels: {
            dropShadow: {
                enabled: false
            }
        },
    };
    var chart = new ApexCharts(document.querySelector("#donut-simple"), options);
    chart.render();

    /* updating donut chart */
    var options = {
        series: [44, 55, 13, 33],
        chart: {
            height: 280,
            type: 'donut',
        },
        dataLabels: {
            enabled: false
        },
        colors: ["#8e54e9", "#4876e6", "#f5b849", "#e6533c", "#49b6f5"],
        legend: {
            position: 'bottom',
        }
    };
    var chart = new ApexCharts(document.querySelector("#donut-update"), options);
    chart.render();

    function appendData() {
        var arr = chart.w.globals.series.slice()
        arr.push(Math.floor(Math.random() * (100 - 1 + 1)) + 1)
        return arr;
    }

    function removeData() {
        var arr = chart.w.globals.series.slice()
        arr.pop()
        return arr;
    }

    function randomize() {
        return chart.w.globals.series.map(function () {
            return Math.floor(Math.random() * (100 - 1 + 1)) + 1
        })
    }

    function reset() {
        return options.series
    }

    document.querySelector("#randomize").addEventListener("click", function () {
        chart.updateSeries(randomize())
    })
    document.querySelector("#add").addEventListener("click", function () {
        chart.updateSeries(appendData())
    })
    document.querySelector("#remove").addEventListener("click", function () {
        chart.updateSeries(removeData())
    })
    document.querySelector("#reset").addEventListener("click", function () {
        chart.updateSeries(reset())
    })

    /* monochrome pie chart */
    var options = {
        series: [25, 15, 44, 55, 41, 17],
        chart: {
            height: '280',
            type: 'pie',
        },
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        theme: {
            monochrome: {
                enabled: true,
                color: "#8e54e9",
            }
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    offset: -5
                }
            }
        },
        dataLabels: {
            formatter(val, opts) {
                const name = opts.w.globals.labels[opts.seriesIndex]
                return [name, val.toFixed(1) + '%']
            },
            dropShadow: {
                enabled: false
            }
        },
        legend: {
            show: false
        },
    };
    var chart = new ApexCharts(document.querySelector("#pie-monochrome"), options);
    chart.render();

    /* graidnet donut chart */
    var options = {
        series: [44, 55, 41, 17, 15],
        chart: {
            height: 300,
            type: 'donut',
        },
        plotOptions: {
            pie: {
                startAngle: -90,
                endAngle: 270
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'gradient',
        },
        legend: {
            formatter: function (val, opts) {
                return val + " - " + opts.w.globals.series[opts.seriesIndex]
            }
        },
        colors: ["#8e54e9", "#4876e6", "#f5b849", "#49b6f5", "#e6533c"],
        legend: {
            position: 'bottom'
        },
    };
    var chart = new ApexCharts(document.querySelector("#donut-gradient"), options);
    chart.render();

    /* patterned donut chart */
    var options = {
        series: [44, 55, 41, 17, 15],
        chart: {
            height: 250,
            type: 'donut',
            dropShadow: {
                enabled: true,
                color: '#111',
                top: -1,
                left: 3,
                blur: 3,
                opacity: 0.2
            }
        },
        stroke: {
            width: 0,
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        total: {
                            showAlways: true,
                            show: true
                        }
                    }
                }
            }
        },
        colors: ["#8e54e9", "#4876e6", "#f5b849", "#49b6f5", "#e6533c"],
        labels: ["Comedy", "Action", "SciFi", "Drama", "Horror"],
        dataLabels: {
            enabled: true,
            style: {
                colors: ['#111']
            },
            background: {
                enabled: true,
                foreColor: '#fff',
                borderWidth: 0
            }
        },
        fill: {
            type: 'pattern',
            opacity: 1,
            pattern: {
                enabled: true,
                style: ['verticalLines', 'squares', 'horizontalLines', 'circles', 'slantedLines'],
            },
        },
        states: {
            hover: {
                filter: 'none'
            }
        },
        theme: {
            palette: 'palette2'
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    var chart = new ApexCharts(document.querySelector("#donut-pattern"), options);
    chart.render();

    /* pie chart with image fill */
    var options = {
        series: [44, 33, 54, 45],
        chart: {
            height: 300,
            type: 'pie',
        },
        colors: ['#93C3EE', '#E5C6A0', '#669DB5', '#94A74A'],
        fill: {
            type: 'image',
            opacity: 0.85,
            image: {
                src: ['http://127.0.0.1:8000/build/assets/images/media/media-21.jpg', 'http://127.0.0.1:8000/build/assets/images/media/media-21.jpg', 'http://127.0.0.1:8000/build/assets/images/media/media-21.jpg', 'http://127.0.0.1:8000/build/assets/images/media/media-21.jpg'],
                width: 25,
                imagedHeight: 25
            },
        },
        stroke: {
            width: 4
        },
        dataLabels: {
            enabled: true,
            style: {
                colors: ['#111']
            },
            background: {
                enabled: true,
                foreColor: '#fff',
                borderWidth: 0
            }
        },
        legend: {
            position: 'bottom'
        },
    };
    var chart = new ApexCharts(document.querySelector("#pie-image"), options);
    chart.render();

})();
