@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('customHeaderScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Update Consignee List</h4>

    <form method="post" action="{{route('division.update',$division->id)}}">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="name">Name of Office</label>
                <input type="text" name="name" value="{{$division->name}}" class="form-control" id="name">
            </div>

            <div class="form-group col-md-2">
                <label for="short_name">Short Name</label>
                <input type="text" name="short_name" value="{{$division->short_name}}"  class="form-control" id="short_name">
            </div>


            <div class="form-group col-md-3">
                <label for="receiving_person_name">Receiving Person</label>
                <input type="text" name="receiving_person_name"  value="{{$division->receiving_person_name}}"  class="form-control" id="receiving_person_name">
            </div>

            <div class="form-group col-md-3">
                <label for="designation">Designation</label>
                <input type="text" name="designation" value="{{$division->designation}}"  class="form-control" id="designation">
            </div>

            <div class="form-group col-md-3">
                <label for="status">Status (Active/Non-Active</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="">None</option>
                    <option value="1"  @if($division->status == "1") selected @endif>Active</option>
                    <option value="0"  @if($division->status == "0") selected @endif>Non Active</option>
                </select>
            </div>




        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>


@section('customFooterScripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
@endsection
