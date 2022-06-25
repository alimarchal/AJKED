@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Suppliers List</h4>

    @if($suppliers->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Name of Firm/Supplier</th>
                <th>AJKED Registration No</th>
                <th>Name of Items</th>
                <th>Stock Code</th>
                <th>Status</th>
                @canany(['edit','delete'])
                    <th class=" d-print-none">Last Update</th>
                    <th class=" d-print-none">Action</th>
                @endcanany
            </tr>
            </thead>
            <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>{{$supplier->name_of_supplier_firm}}</td>
                    <td>{{$supplier->ajked_registration_no}}</td>
                    <td>
                        @if($supplier->supplier_items->isNotEmpty())
                            @foreach($supplier->supplier_items as $item)
                                {{\App\Models\Product::find($item->product_id)->name}},
                            @endforeach
                        @endif
                    </td>

                    <td>
                        @if($supplier->supplier_items->isNotEmpty())
                            @foreach($supplier->supplier_items as $item)
                                {{\App\Models\Product::find($item->product_id)->id}},
                            @endforeach
                        @endif
                    </td>


                    <td>
                        {{$supplier->status}}
                    </td>

                    @canany(['edit','delete'])
                        <td class="text-center d-print-none">
                            {{\Carbon\Carbon::parse($supplier->updated_at)->format('d-m-Y')}}
                        </td>
                        <td class=" d-print-none">
                            <a href="{{route('supplier.edit',$supplier->id)}}" class="btn btn-outline-primary btn-sm" title="Edit Supplier">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>


                    @endcanany

                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
@endsection
