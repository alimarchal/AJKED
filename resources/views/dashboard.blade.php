@include('layouts/header')

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
@include('layouts/sidebar')
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
        @include('layouts/navigation')
        <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Issued To Division ({{date('M')}})
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{\App\Models\StockInOut::where('type','Out')->whereBetween('indent_date', [\Carbon\Carbon::parse(date('Y-m-d'))->firstOfMonth()->format('Y-m-d'),\Carbon\Carbon::parse(date('Y-m-d'))->lastOfMonth()->format('Y-m-d')])->sum('quantity')}}
                                        </div>
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
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Received From Supplier ({{date('M')}})
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{\App\Models\StockInOut::where('type','In')->whereBetween('po_date', [\Carbon\Carbon::parse(date('Y-m-d'))->firstOfMonth()->format('Y-m-d'),\Carbon\Carbon::parse(date('Y-m-d'))->lastOfMonth()->format('Y-m-d')])->sum('quantity')}}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Store Items
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    {{\App\Models\Product::all()->count()}}
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
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Available Quantity
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{number_format(\App\Models\Product::get('quantity')->sum('quantity'),2)}}
                                        </div>
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

                    <div class="col-6 bg-white rounded p-3 m-4">
                        <div id="chart">
                        </div>
                    </div>

                    <div class="col-4 bg-white rounded p-3 m-4">
                        <div id="chart_1">
                        </div>
                    </div>
                    <!-- Area Chart -->
{{--                    <div class="col-xl-8 col-lg-12">--}}
{{--                        <div class="card shadow mb-4">--}}
{{--                            <!-- Card Header - Dropdown -->--}}
{{--                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
{{--                                <h6 class="m-0 font-weight-bold text-primary">Available Store Items</h6>--}}
{{--                                <div class="dropdown no-arrow">--}}
{{--                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>--}}
{{--                                    </a>--}}
{{--                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">--}}
{{--                                        <div class="dropdown-header">Dropdown Header:</div>--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Another action</a>--}}
{{--                                        <div class="dropdown-divider"></div>--}}
{{--                                        <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- Card Body -->--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="chart-area">--}}
{{--                                    <canvas id="myChart"></canvas>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <!-- Pie Chart -->
{{--                    <div class="col-xl-4 col-lg-5">--}}
{{--                        <div class="card shadow mb-4">--}}
{{--                            <!-- Card Header - Dropdown -->--}}
{{--                            <div--}}
{{--                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
{{--                                <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>--}}
{{--                                <div class="dropdown no-arrow">--}}
{{--                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"--}}
{{--                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>--}}
{{--                                    </a>--}}
{{--                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"--}}
{{--                                         aria-labelledby="dropdownMenuLink">--}}
{{--                                        <div class="dropdown-header">Dropdown Header:</div>--}}
{{--                                        <a class="dropdown-item" href="#">Action</a>--}}
{{--                                        <a class="dropdown-item" href="#">Another action</a>--}}
{{--                                        <div class="dropdown-divider"></div>--}}
{{--                                        <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- Card Body -->--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="chart-pie pt-4 pb-2">--}}
{{--                                    <canvas id="myPieChart"></canvas>--}}
{{--                                </div>--}}
{{--                                <div class="mt-4 text-center small">--}}
{{--                                        <span class="mr-2">--}}
{{--                                            <i class="fas fa-circle text-primary"></i> Direct--}}
{{--                                        </span>--}}
{{--                                    <span class="mr-2">--}}
{{--                                            <i class="fas fa-circle text-success"></i> Social--}}
{{--                                        </span>--}}
{{--                                    <span class="mr-2">--}}
{{--                                            <i class="fas fa-circle text-info"></i> Referral--}}
{{--                                        </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        <script>

            var options = {
                chart: {
                    type: 'bar'
                },
                series: [{
                    name: 'Available Store Items',
                    data: [@foreach(\App\Models\Product::where('quantity','>',1)->get() as $item) {{$item->quantity}}, @endforeach]
                }],
                xaxis: {
                    categories: [@foreach(\App\Models\Product::where('quantity','>',1)->get() as $item) "{{$item->name}}", @endforeach]
                }
            }

            var chart = new ApexCharts(document.querySelector("#chart"), options);

            chart.render();


            var options_1 = {
                series: [44, 55, 13, 43, 22],
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
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

            var chart_1 = new ApexCharts(document.querySelector("#chart_1"), options_1);
            chart_1.render();



            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach(\App\Models\Product::where('quantity','>',1)->get() as $item) "{{$item->name}}", @endforeach
                    ],
                    datasets: [{
                        label: 'Available Store Items',
                        data: [
                            @foreach(\App\Models\Product::where('quantity','>',1)->get() as $item) {{$item->quantity}}, @endforeach
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        xAxes: [{
                            ticks: {
                                maxRotation: 90,
                                minRotation: 80
                            },
                            gridLines: {
                                offsetGridLines: true // à rajouter
                            }
                        },
                            {
                                position: "top",
                                ticks: {
                                    maxRotation: 90,
                                    minRotation: 80
                                },
                                gridLines: {
                                    offsetGridLines: true // et matcher pareil ici
                                }
                            }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
        <!-- Footer -->
@include('layouts/footer')
