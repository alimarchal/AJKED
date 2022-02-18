@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Vendors/Suppliers</h4>

    @if($suppliers->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Type</th>
                <th>Category</th>
                <th>Description</th>
                @canany(['edit','delete'])
                    <th>Action</th>
                @endcanany
            </tr>
            </thead>
            <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>{{$supplier->type}}</td>
                    <td>{{$supplier->category}}</td>
                    <td>{{$supplier->description}}</td>
                    @canany(['edit','delete'])
                        <td>
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
