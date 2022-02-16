@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('customHeaderScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Create Store Item</h4>

    <form method="post" action="{{route('product.store')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="category_id">Category</label>
                <select class="form-control select2" id="category_id" name="category_id" required>
                    <option value="" selected>None</option>
                    @foreach(\App\Models\Category::all() as $item)
                        <option value="{{$item->id}}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="unit">Unit</label>
                <select class="form-control select2" id="unit" name="unit" required>
                    <option value="" selected>None</option>
                    @foreach(\App\Models\Product::item_unit() as $item)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>


            <div class="form-group col-md-2">
                <label for="quantity">Quantity:</label>
                <input type="number" min="0" max="100000000" step="0.01" name="quantity" id="quantity" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
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
