@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('customHeaderScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Create Vendors/Suppliers</h4>

    <form method="post" action="{{route('supplier.update',$supplier->id)}}">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="type">Type</label>
                <select class="form-control select2" id="type" name="type[]" multiple required>
                    <option value="">None</option>
                    @foreach(\App\Models\Supplier::supplier_list() as $item)
                        <option value="{{$item}}" @if($item == in_array($item,$type)) selected @endif>{{$item}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="category">Category</label>
                {{$supplier->category}}
                <select class="form-control select2" id="category" name="category" required>
                    @foreach(\App\Models\Supplier::distinct('category')->pluck('category') as $sup)
                        <option value="{{$sup}}" @if($sup == $supplier->category)  selected @endif >{{$sup}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" rows="5" id="description" name="description" required>{{$supplier->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status (Active/Non-Active</label>
            <select class="form-control" id="status" name="status" required>
                <option value="">None</option>
                <option value="Active" @if($supplier->status == "Active") selected @endif>Active</option>
                <option value="NonActive" @if($supplier->status == "NonActive") selected @endif>Non Active</option>
            </select>
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
