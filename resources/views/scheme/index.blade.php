@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Scheme List</h4>

    @if($scheme->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
            <tr class="text-center">
                <th class="text-center">ID</th>
                <th>Approval number</th>
                <th>Date</th>
                <th class="text-center">Name of Scheme</th>
                <th>Type of Scheme</th>
                <th class="text-center">Item Name & Quantity</th>
                <th>Approved by</th>
                <th>Designation</th>
                <th>Name</th>
{{--                @canany(['edit','delete'])--}}
{{--                    <th>Action</th>--}}
{{--                @endcanany--}}
            </tr>
            </thead>
            <tbody>
            @foreach($scheme as $sch)
                <tr>
                    <td class="text-center">
                        {{$sch->id}}
                    </td>
                    <td>{{$sch->approval_number}}</td>
                    <td class="text-center">{{\Carbon\Carbon::parse($sch->date)->format('d-m-Y')}}</td>
                    <td>{{$sch->name_of_scheme}}</td>
                    <td class="text-center">
                        {{$sch->type_of_scheme}}
                    </td>
                    <td>

                        @foreach($sch->scheme_items as $item)
                            Name: <span class="font-weight-bold">{{\App\Models\Product::find($item->product_id)->name}}<br></span>
                            Quantity: <span class="font-weight-bold">{{$item->quantity}}</span> <br>
                        @endforeach

                    </td>
                    <td>{{$sch->designation}}</td>
                    <td>{{$sch->name}}</td>
                    <td>{{$sch->approved_by}}</td>
{{--                    @canany(['edit','delete'])--}}
{{--                        <td>--}}
{{--                            <a href="{{route('division.edit',$sch->id)}}" class="btn btn-outline-primary btn-sm" title="Edit Division">--}}
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
