@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('customHeaderScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Update Store Item</h4>


    <form method="post" action="{{route('product.update',$product->id)}}">
        @csrf
        @method('PUT')
        <div class="form-row">

            <div class="form-group col-md-3">
                <label for="name">Name of item</label>
                <input type="text" name="name" id="name" value="{{$product->name}}" class="form-control">
            </div>

            <div class="form-group col-md-3">
                <label for="unit">Unit</label>
                <select class="form-control select2" id="unit" name="unit" required>
                    @php $flag = false; $unt = $product->unit; @endphp
                    @foreach(\App\Models\Product::item_unit() as $item)
                        <option value="{{$item}}"

                        @if($item == $product->unit)
                            selected
                        @endif

                        >{{$item}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group col-md-3">
                <label for="category_id">Category Code</label>
                <select class="form-control select2" id="category_id" name="category_id" required>

                    @foreach(\App\Models\Category::all() as $item)

                        <option value="{{$item->id}}" @if($product->category_id == $item->id) selected @endif   >{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group col-md-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control select2">
                    <option value="1"  @if($product->status == 1) selected @endif  >Active</option>
                    <option value="0"   @if($product->status == 0) selected @endif  >In-Active</option>
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
