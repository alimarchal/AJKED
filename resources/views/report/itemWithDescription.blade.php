@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('customHeaderScripts')
    <!-- Custom styles for this page -->
    {{--    <link href="{{url('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .vertical-header {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: left;
            margin: auto;
        }

        @media print {
            a:link {
                text-decoration: none!important;
            }
            @page {
                size: auto !important;
            }

            table.table-bordered > thead > tr > th {
                border: 1px solid black !important;
                color: black !important;
            }

            table.table-bordered > tbody > tr > td {
                border: 1px solid black !important;;
                color: black !important;
            }
        }


        table.table-bordered > thead > tr > th {
            border: 1px solid black;
            color: black;
        }

        table.table-bordered > tbody > tr > td {
            border: 1px solid black;
            color: black;
        }


    </style>
@endsection

@section('content')


    <div class="row">
        <button class="btn btn-primary float-right mr-4 d-print-none" onclick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"></path>
            </svg>  Print
        </button>
        <div class="table-responsive">
            <h4 class="h4 mb-4 text-black text-center">Store Item List as of {{\Carbon\Carbon::now()->format('d-m-Y')}}</h4>
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
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
                        <td>{{$key}}</td>
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

@endsection
@section('customFooterScripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
