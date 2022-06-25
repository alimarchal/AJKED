@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('customHeaderScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Create Firm/Supplier</h4>

    <form method="post" action="{{route('supplier.store')}}">
        @csrf
        <div class="form-row">


            <div class="form-group col-md-4">
                <label for="name_of_supplier_firm">Name of Firm/Supplier</label>
                <input type="text" name="name_of_supplier_firm" id="name_of_supplier_firm" class="form-control">
            </div>

            <div class="form-group col-md-3">
                <label for="ajked_registration_no">AJKED Registration Number</label>
                <input type="text" name="ajked_registration_no" id="ajked_registration_no" class="form-control">
            </div>


            <div class="form-group col-md-5">
                <label for="product_id">Name of Item</label>
                <select class="form-control select2" id="product_id" name="product_id[]" multiple required>
                    <option value="">None</option>
                    @foreach(\App\Models\Product::all() as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            {{--            <div class="form-group col-md-6">--}}
            {{--                <label for="type">Type</label>--}}
            {{--                <select class="form-control select2" id="type" name="type[]" multiple required>--}}
            {{--                    <option value="">None</option>--}}
            {{--                    @foreach(\App\Models\Supplier::supplier_list() as $item)--}}
            {{--                        <option value="{{$item}}">{{$item}}</option>--}}
            {{--                    @endforeach--}}
            {{--                </select>--}}
            {{--            </div>--}}
            {{--            <div class="form-group col-md-6">--}}
            {{--                <label for="category">Category</label>--}}
            {{--                <select class="form-control select2" id="category" name="category" required>--}}
            {{--                    @foreach(\App\Models\Supplier::distinct('category')->pluck('category') as $supplier)--}}
            {{--                        <option value="{{$supplier}}">{{$supplier}}</option>--}}
            {{--                    @endforeach--}}
            {{--                </select>--}}
            {{--            </div>--}}

        {{--        <div class="form-group">--}}
        {{--            <label for="description">Description:</label>--}}
        {{--            <textarea class="form-control" rows="5" id="description" name="description" required></textarea>--}}
        {{--        </div>--}}


        <div class="form-group col-md-4">
            <label for="status">Status (Active/Non-Active</label>
            <select class="form-control" id="status" name="status" required>
                <option value="">None</option>
                <option value="Active">Active</option>
                <option value="NonActive">Non Active</option>
                <option value="Blacklisted">Blacklisted</option>
            </select>
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
