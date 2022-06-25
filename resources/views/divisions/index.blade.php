@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Consignee List</h4>

    @if($division->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Name of Office</th>
                <th>Short Name</th>
                <th class="text-center">Receiving Person</th>
                <th>Designation</th>
                <th>Created At</th>
                <th>Status</th>
                @canany(['edit','delete'])
                    Action
                @endcanany
            </tr>
            </thead>
            <tbody>
            @foreach($division as $div)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>{{$div->name}}</td>
                    <td>{{$div->short_name}}</td>
                    <td class="text-center">{{$div->receiving_person_name}}</td>
                    <td>{{$div->designation}}</td>
                    <td class="text-center">{{\Carbon\Carbon::parse($div->created_at)->format('d-m-Y')}}</td>
                    <td>
                        @if($div->status == 1)
                            Active
                            @else
                            Non-Active
                        @endif
                    </td>
                    @canany(['edit','delete'])
                        <td>
                            <a href="{{route('division.edit',$div->id)}}" class="btn btn-outline-primary btn-sm" title="Edit Division">
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
