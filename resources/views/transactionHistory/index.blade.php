@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('customHeaderScripts')
    <!-- Custom styles for this page -->
    {{--    <link href="{{url('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>

    <style>
        @media print {
            .table thead tr td,.table tbody tr td{
                border-width: 1px !important;
                border-style: solid !important;
                border-color: black !important;
                /*padding:0px;*/
                -webkit-print-color-adjust:exact ;
            }

            table.table-bordered > thead > tr > th {
                border: 1px solid #000 !important;
            }

            .rows-print-as-pages {
                page-break-before: always !important;
            }

        }


        @media screen {
            table.table-bordered {
                border: 1px solid #000;
            }

            table.table-bordered > thead > tr > th {
                border: 1px solid #000;
            }

            table.table-bordered > tbody > tr > td {
                border: 1px solid #000;
            }
        }

    </style>
@endsection

@section('content')
    <!-- Page Heading -->
    {{--    <h4 class="h4 mb-4 text-gray-800">Store Items</h4>--}}




    <div class="row">
        <div class="table-responsive">
            @if($transaction->isNotEmpty())


                <form method="get" action="{{route('transactionHistory.index')}}">
                    <div class="filters"  style="display:none;">
                        <div class="form-row">

                            <div class="form-group col-md-3">
                                <label for="product_id">Name of Item</label>
                                <select class="form-control select2bs4" id="product_id" name="filter[product_id]" style="width:100%">
                                    <option value="">None</option>
                                    @foreach(\App\Models\Product::all() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="type">Stock In/Stock Out</label>
                                <select class="form-control select2bs4" id="type" name="filter[type]" style="width:100%">
                                    <option value="">None</option>
                                    <option value="Debit">Stock Out</option>
                                    <option value="Credit">Stock In</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="chalan_type">By Category Stock In/Stock Out</label>
                                <select class="form-control select2bs4" id="chalan_type" name="filter[chalan_type]" style="width:100%">
                                    <option value="">None</option>
                                    <option value="PurchaseOrder">Purchase Order / Stock In</option>
                                    <option value="Scheme">Scheme / Stock In</option>
                                    <option value="Indent">Indent / Stock In</option>
                                    <option value="IndentStockOut">Indent / Stock Out</option>
                                    <option value="SchemeStockOut">Scheme / Stock Out</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="print_per_page">Show Per Page</label>
                                <select class="form-control select2bs4" id="print_per_page" name="print_per_page" style="width:100%">
                                    <option value="">None</option>
                                    <option value="100">100</option>
                                    <option value="150">150</option>
                                    <option value="200">200</option>
                                    <option value="250">250</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <button type="button" class="btn btn-danger hideModule" data-target="filters">Hide Filters
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row d-print-none">
                        <div class="col-md-12 p-3">
                            <a href="javascript:;" class="btn btn-primary showModule float-right" data-target="filters">
                                Show Filters</a>
                            {{--                <input type="submit" name="search" value="Export" class="btn btn-success float-right mr-2">--}}
                        </div>
                    </div>
                </form>

                    <div class="form-row d-print-none">
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary float-right mr-4" onclick="window.print()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"></path>
                                </svg>  Print
                            </button>
                        </div>
                    </div>
                <br>


                <h4 class="h4 mb-4 text-black text-center">Transaction History as of {{\Carbon\Carbon::now()->format('dS F, Y')}}</h4>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">S.No</th>
                        <th class="text-center">Transaction<br>Date</th>
                        <th>Name of Item</th>
                        <th class="text-center">IN/OUT</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Balance</th>
                        <th class="text-center">Chalan Type</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($transaction as $si)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{\Carbon\Carbon::parse($si->general_date)->format('d-m-Y')}}</td>
                            <td>{{$si->product->name}}</td>
                            <td class="text-center">
                                @if($si->type == "Debit")
                                    Stock Out
                                @elseif($si->type == "Credit")
                                    Stock In
                                @endif

                            </td>
                            <td class="text-center">{{$si->quantity}}</td>
                            <td class="text-center">{{$si->balance}}</td>
                            <td class="text-center">
                                @if($si->chalan_type == 'PurchaseOrder')
                                    PO - {{\App\Models\PurchaseOrder::find($si->purchase_order_id)->purchase_order_number}}
                                @elseif($si->chalan_type == 'Scheme')
                                    Scheme -
                                    {{\App\Models\Scheme::find($si->scheme_id)->type_of_scheme}}<br>
                                    {{\App\Models\Scheme::find($si->scheme_id)->name_of_scheme}} -
                                    {{\App\Models\Scheme::find($si->scheme_id)->approval_number}}
                                @elseif($si->chalan_type == 'Indent')
                                    Indent - {{$si->indent_no}}
                                @elseif($si->chalan_type == 'IndentStockOut')
                                    Indent - {{$si->indent_no}}
                                @elseif($si->chalan_type == 'SchemeStockOut')
                                    Scheme -
                                    {{\App\Models\Scheme::find($si->scheme_id)->type_of_scheme}}<br>
                                    {{\App\Models\Scheme::find($si->scheme_id)->name_of_scheme}} -
                                    {{\App\Models\Scheme::find($si->scheme_id)->approval_number}}
                                @endif
                            </td>

                    @endforeach

                    </tbody>

                </table>
            @endif


        </div>
        <span class="d-print-none">{{$transaction->links()}}</span>
    </div>

@endsection
@section('customFooterScripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
    <script>

        $(document).ready(function () {
            $(".showModule").click(function () {
                $("." + $(this).data("target")).slideDown("slow");
                $(this).hide()
            });
            $(".hideModule").click(function () {
                $("." + $(this).data("target")).slideUp("slow");
                $('.showModule').show()
            });
        });

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
