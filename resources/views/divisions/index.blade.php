@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Divisions</h4>

    @if($division->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach($division as $div)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>{{$div->name}}</td>
                    <td>
                        <a href="{{route('division.edit',$div->id)}}" class="btn btn-outline-primary btn-sm" title="Edit Division">
                            <i class="fa fa-edit"></i>
                        </a>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
@endsection
