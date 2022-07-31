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
                    <div class="table-responsive">
                        <table class="table table-bordered  bg-white" id="" width="100%" cellspacing="0">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Opening Balance For The Month</th>
                                <th>Received During Month</th>
                                <th>Issued During Month</th>
                                <th>Present Item Available</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td class="text-center">{{$key}}</td>
                                    <td class="text-left">
                                        <a href="{{route('product.index',['filter[id]' => $key])}}">
                                            {{\App\Models\Product::find($key)->name}}
                                        </a>
                                    </td>
                                    <td class="text-center">{{number_format($value['opening_balance'],2)}}</td>
                                    <td class="text-center">
                                        <a href="{{route('transactionHistory.index',['filter[type]' => 'Credit','filter[product_id]' => $key ])}}">
                                            {{number_format($value['received_during_month'],2)}}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('transactionHistory.index',['filter[type]' => 'Debit','filter[product_id]' => $key ])}}">
                                            {{number_format($value['issue_during_month'],2)}}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('product.index',['filter[id]' => $key])}}">
                                            {{number_format($value['present_item'],2)}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>


            </div>
            <!-- /.container-fluid -->

        </div>

        <!-- Footer -->
@include('layouts/footer')
