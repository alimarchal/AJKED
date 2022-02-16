@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Stock In/Out Log</h4>

    @if($stockInOut->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Item</th>
                    <th>Division</th>
                    <th>Supplier</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Return</th>
                    <th>Issued Date</th>
                    <th>Return Date</th>
                    <th>Description</th>
                    <th>Attachment</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stockInOut as $si)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$si->product->name}}</td>
                        <td>
                            @if(!empty($si->division_id))
                                <a href="{{route('division.index',["filter[id]"=>$si->division_id])}}">{{$si->division_id}}</a>
                            @endif
                        </td>
                        <td>
                            @if(!empty($si->supplier_id))
                                <a href="{{route('supplier.index',["filter[id]"=>$si->supplier_id])}}">{{$si->supplier_id}}</a>
                            @endif

                        </td>
                        <td>{{$si->quantity}}</td>
                        <td>{{$si->price}}</td>
                        <td>{{$si->type}}</td>
                        <td>{{$si->return}}</td>
                        <td>

                            @if(!empty($si->issued_date))
                                {{\Carbon\Carbon::parse($si->issued_date)->format('d-m-Y')}}
                            @endif
                        </td>
                        <td>
                            @if(!empty($si->return_date))
                                {{\Carbon\Carbon::parse($si->return_date)->format('d-m-Y')}}</td>
                            @endif
                        <td>{{$si->description}}</td>
                        <td>
                            @if(!empty($si->attachment_path))
                                <a href="{{Storage::url($si->attachment_path)}}" target="_blank">Download</a>
                            @endif
                        </td>
                @endforeach

                </tbody>
            </table>


            {{ $stockInOut->links() }}

        </div>
    @endif
@endsection
