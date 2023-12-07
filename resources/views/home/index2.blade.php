@extends('layouts.app-master')
@section('content')
    <style>
        .chart-options button {
            padding: 8px 12px;
            border-radius: 3px;
        }

        .chart-options button.active {
            background-color: #1cc88a;
            border-color: #1cc88a;
        }

        .chart-options button:hover {
            opacity: 0.8;
        }

        #myAreaChart {
            height: 300px;
        }
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-info text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-white mb-1">
                                    Earnings (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-warning text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-white mb-1">
                                    Total Kgs de Residuos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total}} Kgs</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-trash"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2 bg-danger text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-white mb-1">Tasks
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 bg-secondary text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-white mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Kgs de Residuos Recogidos x Tiempo</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">

                        <div class="chart-options mb-3">

                            <button class="btn btn-primary active" id="dia">Día</button>
                            <button class="btn btn-primary" id="mes">Mes</button>
                            <button class="btn btn-primary" id="year">Año</button>

                        </div>

                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Kgs Basura Recogida X Zona</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <!--
                                                                                                <span class="mr-2">
                                                                                                    <i class="fas fa-circle text-primary"></i> Direct
                                                                                                </span>
                                                                                                <span class="mr-2">
                                                                                                    <i class="fas fa-circle text-success"></i> Social
                                                                                                </span>
                                                                                                <span class="mr-2">
                                                                                                    <i class="fas fa-circle text-info"></i> Referral
                                                                                                </span>
                                                                                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Kgs de Residuos X Distrito</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($distritos as $distrito)
                            <?php
                            $color = 'bg-info';
                            if (round(($distrito->cantidad / $total) * 100, 2) <= 25) {
                                $color = 'bg-danger';
                            } elseif (round(($distrito->cantidad / $total) * 100, 2) <= 50) {
                                $color = 'bg-warning';
                            } elseif (round(($distrito->cantidad / $total) * 100, 2) <= 75) {
                                $color = 'bg-primary';
                            }
                            ?>
                            <h4 class="small font-weight-bold">
                                <?= $distrito->nombre ?>
                                <span class="float-right"><?= round(($distrito->cantidad / $total) * 100, 2) ?>% -
                                    {{ $distrito->cantidad }} Kgs</span>
                            </h4>

                            <div class="progress mb-4">
                                <div class="progress-bar <?= $color ?>" role="progressbar"
                                    style="width: <?= round(($distrito->cantidad / $total) * 100, 2) ?>%"
                                    aria-valuenow="<?= round(($distrito->cantidad / $total) * 100, 2) ?>"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Color System -->
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                                Primary
                                <div class="text-white-50 small">#4e73df</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body">
                                Success
                                <div class="text-white-50 small">#1cc88a</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-info text-white shadow">
                            <div class="card-body">
                                Info
                                <div class="text-white-50 small">#36b9cc</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-warning text-white shadow">
                            <div class="card-body">
                                Warning
                                <div class="text-white-50 small">#f6c23e</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-danger text-white shadow">
                            <div class="card-body">
                                Danger
                                <div class="text-white-50 small">#e74a3b</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-secondary text-white shadow">
                            <div class="card-body">
                                Secondary
                                <div class="text-white-50 small">#858796</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-light text-black shadow">
                            <div class="card-body">
                                Light
                                <div class="text-black-50 small">#f8f9fc</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-body">
                                Dark
                                <div class="text-white-50 small">#5a5c69</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                src="img/undraw_posting_photo.svg" alt="...">
                        </div>
                        <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank"
                                rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                            constantly updated collection of beautiful svg images that you can use
                            completely free and without attribution!</p>
                        <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                            unDraw &rarr;</a>
                    </div>
                </div>

                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                    </div>
                    <div class="card-body">
                        <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                            CSS bloat and poor page performance. Custom CSS classes are used to create
                            custom components and custom utility classes.</p>
                        <p class="mb-0">Before working with this theme, you should become familiar with the
                            Bootstrap framework, especially the utility classes.</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Incluye la biblioteca de Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <!-- Zonas Chart.js -->
    <script>
        const zonas = [
            <?php foreach ($zonas as $zona): ?> {
                nombre: "<?php echo $zona->nombre; ?>",
                cantidad: <?php echo $zona->cantidad; ?>
            },
            <?php endforeach; ?>
        ];
        if (zonas.length > 1) {

        }

        // Obtener referencia al elemento canvas del DOM
        var ctx = document.getElementById('myPieChart');

        // Datos para el gráfico  
        var data = {
            labels: [
                zonas[0]['nombre'],
                zonas[1]['nombre']
            ],
            datasets: [{
                data: [zonas[0]['cantidad'], zonas[1]['cantidad']],
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a',
                    '#36b9cc'
                ],
                hoverBackgroundColor: [
                    '#2e59d9',
                    '#17a673',
                    '#2c9faf'
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        };

        // Configuración de opciones
        var options = {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
            scales: {
                xAxes: [{
                    ticks: {
                        maxRotation: 0,
                        minRotation: 0,
                        scroll: {
                            mode: 'x',
                            speed: 10 // velocidad en ms  
                        },
                    }
                }]
            }
        };

        // Render del gráfico
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
    </script>
    <script>
        var d_etiquetas = [
            <?php foreach ($dias as $dia): ?> "<?php echo $dia->fecha; ?>",
            <?php endforeach; ?>
        ];

        var d_conjuntoDatos = [
            <?php foreach ($dias as $dia): ?>
            <?php echo $dia->cantidad; ?>,
            <?php endforeach; ?>
        ];

        var m_etiquetas = [
            <?php foreach ($mes as $m): ?> "<?php echo $m->mes; ?>",
            <?php endforeach; ?>
        ];

        var m_conjuntoDatos = [
            <?php foreach ($mes as $m): ?>
            <?php echo $m->cantidad; ?>,
            <?php endforeach; ?>
        ];

        var a_etiquetas = [
            <?php foreach ($anual as $a): ?> "<?php echo $a->anual; ?>",
            <?php endforeach; ?>
        ];

        var a_conjuntoDatos = [
            <?php foreach ($anual as $a): ?>
            <?php echo $a->cantidad; ?>,
            <?php endforeach; ?>
        ];

        // Obtener canvas
        var ctx = document.getElementById("myAreaChart");

        // Datos de prueba
        var data = {
            labels: d_etiquetas,
            datasets: [{
                data: d_conjuntoDatos,
                label: "Kgs de Residuos Recogidos",
                borderColor: "#4e73df",
                fill: true
            }]
        };

        // Configuración inicial
        var options = {
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false
                    }
                }]
            },
            responsive: true
        }

        // Crear chart
        var chart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });

        // Control de botones 
        document.getElementById('dia').addEventListener('click', () => {
            chart.data.labels = d_etiquetas;
            chart.data.datasets[0].data = d_conjuntoDatos;
            chart.update();
        });

        document.getElementById('mes').addEventListener('click', () => {
            chart.data.labels = m_etiquetas;
            chart.data.datasets[0].data = m_conjuntoDatos;
            chart.update();
        });

        document.getElementById('year').addEventListener('click', () => {
            chart.data.labels = a_etiquetas;
            chart.data.datasets[0].data = a_conjuntoDatos;
            chart.update();
        });
    </script>
@endsection
