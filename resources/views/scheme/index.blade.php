@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h3 class="text-center">
        Azad Jammu & Kashmir Electricity Department<br>
        Store Division Muzaffarabad<br>
        Scheme List
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
    @if($scheme->isNotEmpty())
        <table class="table table-striped table-sm table-bordered">
            <thead>
            <tr class="text-center">
                <th scope="col" class="text-center">ID</th>
                <th scope="col" >Approval Number</th>
                <th scope="col" >Date</th>
                <th scope="col"  class="text-center">Scheme</th>
                <th scope="col" >Scheme Type</th>
                <th scope="col"  class="text-center">Item & Quantity</th>
                <th scope="col" >Approved by</th>
                <th scope="col" >Designation</th>
                <th scope="col" >Name</th>
{{--                @canany(['edit','delete'])--}}
{{--                    <th>Action</th>--}}
{{--                @endcanany--}}
            </tr>
            </thead>
            <tbody>
            @foreach($scheme as $sch)
                <tr>
                    <td>
                        {{$sch->id}}
                    </td>
                    <td>{{$sch->approval_number}}</td>
                    <td>{{\Carbon\Carbon::parse($sch->date)->format('d-m-Y')}}</td>
                    <td>{{$sch->name_of_scheme}}</td>
                    <td>
                        {{$sch->type_of_scheme}}
                    </td>
                    <td>

                        @foreach($sch->scheme_items as $item)
                            Name: <span class="font-weight-bold">{{\App\Models\Product::find($item->product_id)->name}}<br></span>
                            Quantity: <span class="font-weight-bold">{{$item->quantity}}</span> -
                            Received: <span class="font-weight-bold">{{$item->balance}}</span> <br>
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
