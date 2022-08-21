@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('customHeaderScripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css"  rel="stylesheet"/>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">
        Create Scheme
    </h4>

    <form method="post" id="myForm" action="{{route('scheme.store')}}" onsubmit="return confirm('Do you really want to submit the form?');">
        @csrf
        <div class="form-row">
{{--            <div class="form-group col-md-4">--}}
{{--                <label for="purchase_order_id">--}}
{{--                    <abbr title="Purchase Order ID must be unique">Purchase Order ID (POID)</abbr>--}}
{{--                </label>--}}
{{--                <input type="text" name="purchase_order_id" class="form-control" id="purchase_order_id">--}}
{{--            </div>--}}
            <div class="form-group col-md-3">
                <label for="approval_number">Approval Number</label>
                <input type="text" name="approval_number" class="form-control" id="approval_number" >
            </div>



            <div class="form-group col-md-3">
                <label for="date">Date</label>
                <input type="date" name="date" onkeydown="return false" class="form-control" id="date" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>

            <div class="form-group col-md-3">
                <label for="name_of_scheme">Name of Scheme</label>
                <input type="text" name="name_of_scheme" class="form-control" id="name_of_scheme">
            </div>

            <div class="form-group col-md-3">
                <label for="type_of_scheme">Type of Scheme</label>
                <select class="form-control select2" id="type_of_scheme" name="type_of_scheme" required>
                    <option value="" >None</option>
                    <option value="Normal" >Normal</option>
                    <option value="Deposit" >Deposit</option>
                    <option value="Development" >Development (ADP)</option>
                </select>
            </div>



            <div class="form-group col-md-3">
                <label for="designation">Designation</label>
                <input type="text" name="designation" class="form-control" id="designation">
            </div>


            <div class="form-group col-md-3">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>

            <div class="form-group col-md-3">
                <label for="approved_by">Approved By</label>
                <input type="text" name="approved_by" class="form-control" id="approved_by">
            </div>

{{--            <div class="form-group col-md-3">--}}
{{--                <label for="status">Status (Running/Completed)</label>--}}
{{--                <select class="form-control select2" id="status" name="status" required>--}}
{{--                    <option value="">None</option>--}}
{{--                    <option value="Running">Running</option>--}}
{{--                    <option value="Completed">Completed</option>--}}
{{--                </select>--}}
{{--            </div>--}}

        </div>


        <div class="myrow">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="" class="text-danger">Store Item</label>
                    {{--                //product_id[]--}}
                    <select class="form-control select2" name="store_item[0]" required style="width: 100%;">
                        <option value="" selected>Please select store item</option>
                        @foreach(\App\Models\Product::all() as $item)
                            <option value="{{$item->id}}">ID: {{$item->id}} - {{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="quantity">Quantity</label>
                    <input type="number" min="0.01" max="100000000" required step="0.01" name="quantity[]" id="quantity" class="form-control">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <a id="add_more" type="" class="btn btn-success float-right">Add More</a>
            </div>
        </div>

        <input type="submit" id="submit" class="btn btn-primary" value="Submit">
    </form>

    <div class="newqual" style="display: none">

        <div class="row">
            <div class="cross col-md-12">
                <a href="javascript:(0);" class="btn btn-danger float-right">Delete</a>
            </div>
            <div class="form-group col-md-6">
                <label for="store_item" class="text-danger">Item Name</label>
{{--                //product_id[]--}}
                <select class="form-control select2" name="store_item[xcount_replaceable]" required style="width: 100%;">
                    <option value="" selected>Please select item name</option>
                    @foreach(\App\Models\Product::all() as $item)
                        <option value="{{$item->id}}">{{$item->id}} : {{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="quantity">Quantity</label>
                <input type="number" min="0.01" max="100000000" required step="0.01" name="quantity[]" id="quantity" class="form-control">
            </div>
        </div>
    </div>

    @section('customFooterScripts')
        <script>

            $('#myForm').on('submit', function () {
                $('#submit').attr('disabled', 'disabled');
            });

            $(document).ready(function () {
                var traing_count = 1;
                $('.select2').select2();


                $("body").delegate("#add_more", "click", function () {

                    var training_html = $('.newqual').html();

                    training_html = training_html.replaceAll('xcount_replaceable',traing_count);
                    traing_count++;

                    $('.myrow').append(training_html);
                    // $('.myrow').append(training_html);
                    //
                    // $('.myrow').append($('.newqual').html());
                    // $("form .select2").select2();

                });
                $("body").delegate(".cross a", "click", function () {
                    $(this).closest(".row").remove();
                    return false;
                });

            });
        </script>
    @endsection
@endsection
