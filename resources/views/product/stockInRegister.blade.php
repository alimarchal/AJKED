@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('customHeaderScripts')
    <!-- Custom styles for this page -->
    {{--    <link href="{{url('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>


    <link rel="stylesheet" href="{{url('css/daterangepicker.min.css')}}">
    <script src="{{url('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{url('js/moment.min.js')}}"></script>
    <script src="{{url('js/knockout-3.5.1.js')}}" defer></script>
    <script src="{{url('js/daterangepicker.min.js')}}" defer></script>

    <style>
        .vertical-header {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: left;
            margin: auto;
        }

        @media print {
            @page {
                size: auto !important
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

    <form action="{{route('product.stockOutRegister')}}" method="get" class="d-print-none">
        <div class="form-row">


            <div class="form-group col-md-4">
                <label for="division_id">Division</label>
                <select class="form-control select2" id="division_id" name="division_id" style="width: 100%;">
                    <option value="" selected>Please select division</option>
                    @foreach(\App\Models\Division::all() as $item)
                        <option value="{{$item->id}}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="month">Please Select Month</label>
                {{--                <input type="date" class="form-control" id="month" name="month">--}}
                <input type="search" name="date_range" id="date_range" class="form-control">
            </div>

{{--            <div class="form-group col-md-3">--}}
{{--                --}}
{{--            </div>--}}


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
    <h4 class="h4 mb-4 text-dark font-weight-bold text-center"> Store Stock Register Store Division Electricity Muzaffarabad (Issued) <br>
        Month: {{\Carbon\Carbon::parse($date_from)->format('M/Y')}} </h4>

    <table class="table table-sm table-bordered table-responsive">
        <thead style="white-space: nowrap">
        <tr>
            <th></th>
            <th></th>
            <th></th>

            @foreach(\App\Models\Product::all() as $product)
                <th scope="col">
                    <div class="vertical-header">{{$product->unit}}</div>
                </th>
            @endforeach
            <th scope="col">
            </th>
        </tr>
        <tr>
            <th scope="col" style="writing-mode: vertical-rl; transform: rotate(180deg); text-align: center; vertical-align: middle;">Indent No.</th>
            <th scope="col" style="margin: auto; vertical-align: middle; text-align: center; width: 50px!important;;">Date</th>
            <th scope="col" style="margin: auto; vertical-align: middle; text-align: center; width: 100px!important;;">Particulars</th>

            @foreach(\App\Models\Product::all() as $product)
                <th scope="col">
                    <div class="vertical-header">{{$product->name}}</div>
                </th>
            @endforeach

            <th scope="col">
                <div class="vertical-header">Total</div>
            </th>
        </tr>

        <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>

            @foreach(\App\Models\Product::all() as $product)
                <th scope="col" style="text-align: center;">{{$loop->iteration}}</th>
            @endforeach
            <th scope="col" style="text-align: center;"></th>
        </tr>
        </thead>
        <tbody>
        @php $horizantal_sum = 0; $vertical_sum = 0; @endphp

        {{--    @foreach($stock_in_out as $si)--}}
        {{--        <tr>--}}
        {{--            <td style="white-space: nowrap;">{{$si->indent_no}}</td>--}}
        {{--            <td style="white-space: nowrap;">{{\Carbon\Carbon::parse($si->indent_date)->format('d-m-Y')}}</td>--}}
        {{--            <td style="white-space: nowrap;">{{$si->name}}</td>--}}
        {{--            <td style="white-space: nowrap;">{{$si->product_id}}</td>--}}

        {{--            @foreach(\App\Models\Product::all() as $product)--}}
        {{--                <td class="text-center">--}}
        {{--                    @if($si->product_id == $product->id)--}}
        {{--                        {{$si->quantity}}--}}
        {{--                    @else--}}
        {{--                        ---}}
        {{--                    @endif--}}
        {{--                </td>--}}
        {{--            @endforeach--}}
        {{--            <td>{{$si->quantity}}</td>--}}
        {{--        </tr>--}}
        {{--    @endforeach--}}


        @php $horizantal_sum = 0; $horizantal_sum_grand = 0; $vertical_sum = 0; @endphp

        @foreach($data as $key => $value)
            <tr>
                <td style="white-space: nowrap;">{{$key}}</td>
                @foreach($value as $k => $v)
                    <td style="white-space: nowrap;">{{\Carbon\Carbon::parse($k)->format('d-m-Y')}}</td>
                    @foreach($v as $i => $x)
                        <td style="white-space: nowrap;">{{$i}}</td>
                        @foreach(\App\Models\Product::all() as $product)
                            @php $found = false; @endphp
                            @foreach($x as $a => $b)
                                @if($b->product_id === $product->id)
                                    <td class="text-center">{{$b->quantity}}</td>
                                    @php
                                        $found = true;
                                        $horizantal_sum = $horizantal_sum +$b->quantity;
                                    @endphp
                                @endif
                            @endforeach
                            @if(!$found)
                                <td class="text-center">-</td>
                            @endif
                        @endforeach
                        <td class="text-right font-weight-bold text-danger">{{number_format($horizantal_sum,2)}}</td>
                        @php $horizantal_sum = 0; @endphp
                    @endforeach
                @endforeach

            </tr>
        @endforeach


        {{--    @foreach($data as $key => $value)--}}
        {{--        @foreach($value as $k => $v)--}}
        {{--            <tr>--}}
        {{--                <td style="white-space: nowrap;">{{$v->indent_no}}</td>--}}

        {{--                <td style="white-space: nowrap;">{{\Carbon\Carbon::parse($key)->format('d-m-Y')}}</td>--}}
        {{--                <td style="white-space: nowrap;">{{$v->name}}</td>--}}
        {{--                @foreach(\App\Models\Product::all() as $product)--}}
        {{--                    <td class="text-center">--}}
        {{--                        @if(isset($value[$product->id]))--}}
        {{--                            {{$value[$product->id]->quantity}}--}}
        {{--                            @php $horizantal_sum = $horizantal_sum + $value[$product->id]->quantity;--}}
        {{--                            @endphp--}}
        {{--                        @else--}}
        {{--                            ---}}
        {{--                        @endif--}}
        {{--                    </td>--}}
        {{--                @endforeach--}}

        {{--                <td class="text-center">--}}
        {{--                    {{$horizantal_sum}}--}}
        {{--                </td>--}}
        {{--                @php--}}
        {{--                    $horizantal_sum = 0;--}}
        {{--                @endphp--}}
        {{--            </tr>--}}
        {{--        @endforeach--}}
        {{--    @endforeach--}}


        <tr class="font-weight-bold">
            <td colspan="3" class="text-center">Total</td>

            @foreach(\App\Models\Product::all() as $product)
                <td class="text-center text-danger">
                    @if($stock_in_out->where('product_id',$product->id)->sum('quantity') == 0)
                        -
                    @else
                        {{number_format($stock_in_out->where('product_id',$product->id)->sum('quantity'),2)}}
                        @php $horizantal_sum_grand = $horizantal_sum_grand + $stock_in_out->where('product_id',$product->id)->sum('quantity'); @endphp
                    @endif
                </td>
            @endforeach

            <td class="text-center text-danger">
                {{number_format($horizantal_sum_grand,2)}}
            </td>

        </tr>


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

    <script>
        $(document).ready(function () {
            $("#date_range").daterangepicker({
                minDate: moment().subtract(10, 'years'),
                orientation: 'left',
                callback: function (startDate, endDate, period) {
                    $(this).val(startDate.format('L') + ' – ' + endDate.format('L'));
                }
            });
        });
    </script>
@endsection
