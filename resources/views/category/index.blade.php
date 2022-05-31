@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">All Categories</h4>

    @if($category->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Name</th>
                <th>Status</th>
                <th>Last Updated</th>
                @canany(['edit','delete'])
                    <th>Actions</th>
                @endcanany
            </tr>
            </thead>
            <tbody>
            @foreach($category as $cat)
                <tr>
                    <td class="text-center">{{$cat->id}}</td>
                    <td>{{$cat->name}}</td>
                    <td>
                        @if($cat->status)
                            Active
                        @else
                            In-Active
                        @endif
                    </td>
                    <td>{{\Carbon\Carbon::parse($cat->updated_at)->format('d-m-Y')}}</td>
                    @canany(['edit','delete'])
                        <td>
                            <a href="{{route('category.edit',$cat->id)}}" class="btn btn-outline-primary btn-sm" title="Edit Division">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    @endcanany
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $category->links() }}
    @endif
@endsection
