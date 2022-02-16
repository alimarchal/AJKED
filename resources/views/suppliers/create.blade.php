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

    <form method="post" action="{{route('supplier.store')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="type">Type</label>
                <select class="form-control select2" id="type" name="type[]" multiple required>
                    <option value="">None</option>
                    @foreach(\App\Models\Supplier::supplier_list() as $item)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="category">Category</label>
                <select class="form-control select2" id="category" name="category" required>
                    @foreach(\App\Models\Supplier::distinct('category')->pluck('category') as $supplier)
                        <option value="{{$supplier}}">{{$supplier}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" rows="5" id="description" name="description" required></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status (Active/Non-Active</label>
            <select class="form-control" id="status" name="status" required>
                <option value="">None</option>
                <option value="Active">Active</option>
                <option value="NonActive">Non Active</option>
            </select>
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
