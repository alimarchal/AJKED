@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Store Items</h4>

    @if($storeItems->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Category</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($storeItems as $si)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>{{$si->category}}</td>
                    <td>{{$si->name}}</td>
                    <td>{{$si->unit}}</td>
                    <td>
                        <a href="{{route('storeItem.edit',$si->id)}}" class="btn btn-outline-primary btn-sm" title="Edit Supplier">
                            <i class="fa fa-edit"></i>
                        </a>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
@endsection
