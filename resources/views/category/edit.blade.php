@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('customHeaderScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Edit Category</h4>

    <form method="post" action="{{route('category.update',$category->id)}}">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="type">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$category->name}}">
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
