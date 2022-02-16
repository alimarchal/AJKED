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

    <form method="post" action="{{route('storeItem.update',$storeItem->id)}}">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="category">Category</label>
                <select class="form-control select2" id="category" name="category" required>
                    <option value="">None</option>
                    @foreach(\App\Models\StoreItem::store_item_categories() as $item)
                        <option value="{{$item}}" @if($storeItem->category == $item) selected @endif>{{$item}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="unit">Unit</label>
                <select class="form-control select2" id="unit" name="unit" required>
                    @foreach(\App\Models\StoreItem::item_unit() as $item)
                        <option value="{{$item}}" @if($storeItem->unit == $item) selected @endif>{{$item}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$storeItem->name}}">
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
