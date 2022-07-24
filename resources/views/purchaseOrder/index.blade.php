@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h3 class="text-center">
        Azad Jammu & Kashmir Electricity Department<br>
        Store Division Muzaffarabad<br>
        Purchase Order (PO) List
    </h3>

    <form action="#" method="get" class=" d-print-none">
        <div class="form-row">

            <div class="form-group col-md-12">
                <button class="btn btn-primary float-right mr-4" onclick="window.print()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"></path>
                    </svg>  Print
                </button>
            </div>
        </div>
    </form>
    @if($purchaseOrder->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">POID</th>
                <th>PO Number</th>
                <th>PO Date</th>
                <th class="text-center">Name of Firm/Supplier</th>
                <th class="text-center">Item Name & Quantity</th>
                <th>Reference #</th>
                <th>Attachment</th>
                <th>PO Status</th>
{{--                @canany(['edit','delete'])--}}
{{--                    <th class="text-center"> Action </th>--}}
{{--                @endcanany--}}
            </tr>
            </thead>
            <tbody>
            @foreach($purchaseOrder as $po)
                <tr>
                    <td class="text-center">{{$po->id}}</td>
                    <td class="text-center">{{$po->purchase_order_number}}</td>
                    <td class="text-center">{{\Carbon\Carbon::parse($po->purchase_order_date)->format('d-m-Y')}}</td>
                    <td class="text-center">{{\App\Models\Supplier::find($po->name_of_firm_supplier)->name_of_supplier_firm}}</td>
                    <td>
                        @foreach($po->purchase_order_items as $item)
                            Name: <span class="font-weight-bold">{{\App\Models\Product::find($item->product_id)->name}}<br></span>
                            Quantity: <span class="font-weight-bold">{{$item->quantity}} - Received: {{$item->balance}}</span> <br>
                        @endforeach


                    </td>
                    <td class="text-center">{{$po->reference_number}}</td>
                    <td class="text-center">
                        @if(!empty($po->attachment))
                            <a href="{{Storage::url($po->attachment)}}" target="_blank">View</a>
                        @else
                            #N/A
                        @endif
                    </td>
                    <td>
                        @if($po->status == "Running")
                            Running
                            @else
                            Completed
                        @endif
                    </td>
{{--                    @canany(['edit','delete'])--}}
{{--                        <td class="text-center">--}}
{{--                            <a href="{{route('division.edit',$po->id)}}" class="btn btn-outline-primary btn-sm" title="Edit Division">--}}
{{--                                <i class="fa fa-edit"></i>--}}
{{--                            </a>--}}
{{--                        </td>--}}
{{--                    @endcanany--}}
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
@endsection
