@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Purchase Order (PO) List</h4>

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
