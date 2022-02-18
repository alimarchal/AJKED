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

                    <div class="col-xl-4 col-md-6 mb-4">
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

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Available Store Items
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    {{\App\Models\Product::where('quantity','>=',1)->count()}}
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

                    <div class="col-xl-4 col-md-6 mb-4">
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

                    <div class="col-2"></div>
                    <div class="col-xl-4 col-md-6 mb-4">
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
                    <div class="col-xl-4 col-md-6 mb-4">
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

                    <div class="col-2"></div>

                    <!-- Pending Requests Card Example -->

                </div>

                <!-- Content Row -->

                <div class="row">
                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <div class="col-12 bg-white rounded p-3 m-4">
                        <div id="container_1"></div>
                    </div>

                    <div class="col-12 bg-white rounded p-3 m-4">
                        <div id="container"></div>
                    </div>


                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
        <script>


            // Create the chart
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Available Store Items as of {{date('d-M-Y')}}'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total Quantity (Mixed Unit)'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                },

                series: [
                    {
                        name: "Quantity",
                        colorByPoint: true,
                        data: [
                            @foreach(\App\Models\Product::where('quantity','>=',1)->get() as $item)
                            {
                                name: "{{$item->name}}",
                                y: {{$item->quantity}},
                            },

                        @endforeach

                        ]
                    }
                ],
            });



            Highcharts.chart('container_1', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Available Store Items as of {{date('d-M-Y')}}'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>'
                        }
                    }
                },
                series: [{
                    name: 'Total Percentage',
                    colorByPoint: true,
                    data: [
                        @foreach(\App\Models\Product::where('quantity','>=',1)->get() as $item)
                            {
                                name: "{{$item->name}}<br>Quantity {{$item->quantity}}",
                                y: {{$item->quantity}},
                                sliced: true,
                                selected: true
                            },
                        @endforeach

                    ]
                }]
            });


        </script>
        <!-- Footer -->
@include('layouts/footer')
