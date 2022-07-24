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

                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Store Item Types
                                        </div>
                                        <div class="row no-gutters float-right">
                                            <div class="col-auto ">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <a href="{{route('product.index')}}">{{\App\Models\Product::all()->count()}}</a>
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

                </div>

                <!-- Content Row -->

                <div class="row bg-white">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Opening Balance For The Month</th>
                                <th>Received During Month</th>
                                <th>Issued During Month</th>
                                <th>Present Item Available</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-left">Transformers</td>
                                <td>
                                    0.00
{{--                                    @if(!empty(\App\Models\StockInOut::where('product_id', 2)->whereBetween('created_at', [\Carbon\Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d 00:00:00'),\Carbon\Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d 23:59:59'),])->latest()->first()))--}}
{{--                                        {{\App\Models\StockInOut::where('product_id', 2)->whereBetween('created_at', [\Carbon\Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d 00:00:00'),\Carbon\Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d 23:59:59'),])->latest()->first()->quantity}}--}}
{{--                                    @endif--}}
                                </td>
                                <td>
                                    0.00
{{--                                    @if(!empty(\App\Models\StockInOut::where('product_id',2)->where('type','Credit')->whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')])->get()->isNotEmpty()))--}}
{{--                                        {{number_format(\App\Models\StockInOut::where('product_id',2)->where('type','Credit')->whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')])->get()->sum('quantity'),2)}}--}}
{{--                                    @endif--}}
                                </td>
                                <td>
                                    0.00
{{--                                    @if(!empty(\App\Models\StockInOut::where('product_id',2)->where('type','Debit')->whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')])->get()->isNotEmpty()))--}}
{{--                                        {{number_format(\App\Models\StockInOut::where('product_id',2)->where('type','Debit')->whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')])->get()->sum('quantity'),2)}}--}}
{{--                                    @endif--}}
                                </td>
                                <td>
                                    0.00
{{--                                    @if(!empty(\App\Models\Product::find(2)))--}}
{{--                                        {{\App\Models\Product::find(2)->quantity}}--}}
{{--                                    @endif--}}
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-left">HT Sturcture</td>
                                <td>
                                    0.00
{{--                                    {{\App\Models\StockInOut::where('product_id', 3)->whereBetween('created_at', [\Carbon\Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d 00:00:00'),\Carbon\Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d 23:59:59'),])->latest()->first()->quantity}}--}}
                                </td>
                                <td>
                                    0.00
{{--                                    {{number_format(\App\Models\StockInOut::where('product_id',3)->where('type','Credit')->whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')])->get()->sum('quantity'),2)}}--}}
                                </td>
                                <td>
                                    0.00
{{--                                    {{number_format(\App\Models\StockInOut::where('product_id',3)->where('type','Debit')->whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')])->get()->sum('quantity'),2)}}--}}
                                </td>
                                <td>
                                    0.00
{{--                                    {{\App\Models\Product::find(3)->quantity}}--}}
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="text-left">LT Sturcture</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td class="text-left">HT Conductor</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td class="text-left">LT Conductor</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td class="text-left">Meters</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td class="text-left">Panels</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td class="text-left">Cabels</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td class="text-left">Enamalled Wire</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td class="text-left">Transformer Oil</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                            </tr>

                            <tr>
                                <td>11</td>
                                <td class="text-left">Other Items</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>0.00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>

        <!-- Footer -->
@include('layouts/footer')
