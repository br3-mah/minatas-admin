<div class="row">

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Loan Status Overview</h4>
            </div>
            <div class="card-body">
                <div id="donut_chart_loans" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Loan Status Bar Overview</h4>
            </div>
            <div class="card-body">
                <div id="bar_chart_loans" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Performance</h4>
                <!-- Advanced Filter Options -->
                <div class="filter-options">
                    <select id="filter-series" class="form-control">
                        <option value="all">Show All</option>
                        <option value="performing">Performing</option>
                        <option value="nonPerforming">Non-Performing</option>
                    </select>
                    <input type="color" id="color-performing" value="#d08820" title="Pick a color for Performing">
                    <input type="color" id="color-nonPerforming" value="#02c8dc" title="Pick a color for Non-Performing">
                    <button id="apply-color" class="btn btn-primary">Apply Colors</button>
                </div>
            </div>
            <div class="card-body">
                <div id="column_chart_performance" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vertical Bar Chart Options
    var options = {
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '45%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        series: [{
            name: 'Loans',
            data: [
                @json($closedLoansCount),
                @json($rejectedLoansCount),
                @json($pendingLoansCount),
                @json($loansCount),
                @json($unresolvedLoansAmount)
            ]
        }],
        colors: ['#FF4560', '#008FFB', '#FEB019', '#00E396', '#775DD0'],
        xaxis: {
            categories: ['Closed Loans', 'Rejected Loans', 'Pending Loans', 'Loans', 'Unresolved Loans'],
            title: {
                text: 'Loan Status'
            }
        },
        yaxis: {
            title: {
                text: 'Count'
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: "vertical",
                shadeIntensity: 0.25,
                gradientToColors: undefined,
                inverseColors: true,
                opacityFrom: 0.85,
                opacityTo: 0.85,
                stops: [50, 0, 100, 100]
            }
        },
        grid: {
            borderColor: '#f1f1f1',
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " count";
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#bar_chart_loans"), options);
    chart.render();
});

document.addEventListener('DOMContentLoaded', function() {
    // Gradient Donut Chart Options
    var options = {
        chart: {
            height: 350,
            type: 'donut'
        },
        series: [
            @json($closedLoansCount),
            @json($rejectedLoansCount),
            @json($pendingLoansCount),
            @json($loansCount),
            @json($unresolvedLoansAmount)
        ],
        labels: ['Closed Loans', 'Rejected Loans', 'Pending Loans', 'Open Loans', 'Unresolved Loans'],
        colors: ['#FF4560', '#008FFB', '#FEB019', '#00E396', '#775DD0'],
        fill: {
            type: 'gradient',
        },
        legend: {
            position: 'bottom'
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(2) + "%"
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    height: 300
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " count";
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#donut_chart_loans"), options);
    chart.render();
});

document.addEventListener('DOMContentLoaded', function() {
    var chartElement = document.querySelector("#column_chart_performance");

    // Initial Colors
    var chartColors = {
        performing: document.getElementById('color-performing').value,
        nonPerforming: document.getElementById('color-nonPerforming').value
    };

    // Initial Data
    var seriesData = {
        performing: @json($chartData['performing']),
        nonPerforming: @json($chartData['nonPerforming'])
    };

    var options = {
        chart: {
            height: 350,
            type: "bar",
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "45%",
                endingShape: "rounded"
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"]
        },
        series: [{
            name: "Performing",
            data: seriesData.performing
        }, {
            name: "Non-Performing",
            data: seriesData.nonPerforming
        }],
        colors: [chartColors.performing, chartColors.nonPerforming],
        xaxis: {
            categories: @json($chartData['months'])
        },
        yaxis: {
            title: {
                text: "Number of Applications"
            }
        },
        grid: {
            borderColor: "#f1f1f1"
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " applications"
                }
            }
        }
    };

    var chart = new ApexCharts(chartElement, options);
    chart.render();

    // Event Listener for Filter
    document.getElementById('filter-series').addEventListener('change', function() {
        var selectedSeries = this.value;
        if (selectedSeries === 'all') {
            chart.updateSeries([{
                name: "Performing",
                data: seriesData.performing
            }, {
                name: "Non-Performing",
                data: seriesData.nonPerforming
            }]);
        } else if (selectedSeries === 'performing') {
            chart.updateSeries([{
                name: "Performing",
                data: seriesData.performing
            }]);
        } else if (selectedSeries === 'nonPerforming') {
            chart.updateSeries([{
                name: "Non-Performing",
                data: seriesData.nonPerforming
            }]);
        }
    });

    // Event Listener for Color Customization
    document.getElementById('apply-color').addEventListener('click', function() {
        chartColors.performing = document.getElementById('color-performing').value;
        chartColors.nonPerforming = document.getElementById('color-nonPerforming').value;

        chart.updateOptions({
            colors: [chartColors.performing, chartColors.nonPerforming]
        });
    });
});
</script>
