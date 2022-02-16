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

    <form method="post" action="{{route('product.stockOutStore')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="division_id" class="text-danger">Division</label>
                <select class="form-control select2" id="division_id" name="division_id" required style="width: 100%;">
                    <option value="" selected>Please select division</option>
                    @foreach(\App\Models\Division::all() as $item)
                        <option value="{{$item->id}}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>


            <input type="hidden" name="type" value="Out">

            <div class="form-group col-md-6">
                <label for="indent_no">Indent No</label>
                <input type="text" name="indent_no" required id="indent_no" class="form-control">
            </div>


            <div class="form-group col-md-6">
                <label for="indent_date">Stock Out Date</label>
                <input type="date" name="indent_date" max="{{date('Y-m-d')}}" required id="indent_date" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="product_id" class="text-danger">Store Item</label>
                <select class="form-control " id="product_id" name="product_id[]" required style="width: 100%;">
                    <option value="" selected>Please select quantity</option>
                    @foreach($product->where('quantity','>',0) as $item)
                        <option value="{{$item->id}}">({{$item->category->name}}) {{$item->name}} | Quantity: ({{$item->quantity}})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="quantity">Quantity</label>
                <input type="number" min="1" max="100000000" required step="0.01" name="quantity[]" id="quantity" class="form-control">
            </div>
        </div>

        <div class="myrow">

        </div>




        <div class="row">
            <div class="col-md-12">
                <a id="add_more" type="" class="btn btn-success float-right"> Add More</a>
            </div>
        </div>





        <button type="submit" class="btn btn-primary">Confirm</button>
    </form>


    <div class="newqual" style="display: none">

        <div class="row">
            <div class="cross col-md-12">
                <a href="javascript:(0);" class="btn btn-danger float-right">Delete</a>
            </div>
            <div class="form-group col-md-6">
                <label for="product_id" class="text-danger">Store Item</label>
                <select class="form-control" id="product_id" name="product_id[]" required style="width: 100%;">
                    <option value="" selected>Please select quantity</option>
                    @foreach($product->where('quantity','>',0) as $item)
                        <option value="{{$item->id}}">({{$item->category->name}}) {{$item->name}} | Quantity: ({{$item->quantity}})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="quantity">Quantity</label>
                <input type="number" min="1" max="100000000" required step="0.01" name="quantity[]" id="quantity" class="form-control">
            </div>
        </div>
    </div>


@section('customFooterScripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function () {
            var traing_count = 1;
            $('.select2').select2();


            $("body").delegate("#add_more", "click", function () {
                $('.myrow').append($('.newqual').html());
                $("form .select2").select2();
            });
            $("body").delegate("#add_more_integrent", "click", function () {

                var training_html = $('.newqual').html();

                training_html = training_html.replaceAll('xcount_replaceable',traing_count);
                traing_count++;


                $('.myrow').append(training_html);
            });
            $("body").delegate(".cross a", "click", function () {
                $(this).closest(".row").remove();
                return false;
            });

        });
    </script>
@endsection
@endsection
