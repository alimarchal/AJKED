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
            @page {
                size: auto !important;

            }

            table.table-bordered > thead > tr > th {
                border: 1px solid black !important;
                color: black !important;;
            }

            table.table-bordered > tbody > tr > td {
                border: 1px solid black !important;;
                color: black !important;;
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

    <form action="{{route('report.stockReturn')}}" method="get" class="d-print-none">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="month">Please Select Month</label>
                <input type="date" class="form-control" id="month" name="month">

            </div>

            <div class="form-group col-md-4">
            </div>


            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success float-right ml-4">Search</button>
                <button class="btn btn-primary float-right mr-4" onclick="window.print()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        <path
                            d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                    </svg>
                    Print
                </button>
            </div>


        </div>
    </form>
    <br>

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-dark font-weight-bold text-center text-uppercase"> Store Stock Return Electricity Division Muzaffarabad For the month of
        {{\Carbon\Carbon::parse($date_from)->format('m/Y')}}
    </h4>


    <table class="table table-bordered table-responsive">
        <thead>

        <tr class="text-center">
            <th rowspan="2" style="vertical-align : middle;text-align:center;" >S#</th>
            <th rowspan="2" style="vertical-align : middle;text-align:center;">Name of Item</th>
            <th  rowspan="2" style="vertical-align : middle;text-align:center;">Unit</th>
            <th rowspan="2" style="vertical-align : middle;text-align:center;">Received Material During {{\Carbon\Carbon::parse($date_from)->format('m/Y')}}</th>
            <th colspan="{{\App\Models\Division::count()+1}}" style="vertical-align : middle;text-align:center;"> Issued</th>
            <th rowspan="2" style="vertical-align : middle;text-align:center;">Closing Balance Ending {{\Carbon\Carbon::parse($date_from)->format('m/Y')}}</th>>
        </tr>
        <tr class="text-center">


            @foreach(\App\Models\Division::all() as $div)
                <th style="white-space: nowrap;vertical-align : middle;text-align:center;">{!! $div->short_name !!}</th>
            @endforeach

            <th>Total Issued</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Models\Product::all() as $product)
            <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td style="white-space: nowrap">{{$product->name}}</td>
                <td class="text-center">{{$product->unit}}</td>
                <td class="text-center">
                    @if($received_material->where('product_id', $product->id)->isNotEmpty())
                        {{$received_material->where('product_id', $product->id)->first()->quantity}}
                    @else
                        0
                    @endif
                </td>
                @php
                    $horizantal_sum = 0;
                @endphp
                @foreach(\App\Models\Division::all() as $div)
                    @php
                        $found = false;
                    @endphp

                    @foreach($stock_in_out as $si)
                        @if($div->id == $si->division_id && $si->product_id == $product->id)
                            <td class="text-center">{{ $si->quantity }}</td>
                            @php $found = true; $horizantal_sum = $horizantal_sum + $si->quantity @endphp
                        @endif
                    @endforeach

                    @if(!$found)
                        <td class="text-center">0</td>
                    @endif

                @endforeach

                <td class="text-right font-weight-bold">{{ number_format($horizantal_sum,2) }}</td>
                <td class="text-right font-weight-bold">{{ number_format($product->quantity,2) }}</td>

                @php
                    $horizantal_sum = 0;
                @endphp
            </tr>
        @endforeach
        </tbody>
    </table>



@endsection
@section('customFooterScripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
