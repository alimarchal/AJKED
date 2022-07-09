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
        Stock Out
    </h4>

    <form method="post" action="{{route('product.stockOutStore')}}" onsubmit="return confirm('Do you really want to submit the form?');" enctype="multipart/form-data">
        @csrf
        <div class="form-row">

            <div class="form-group col-md-3">
                <label for="indent_no">Indent No</label>
                <input type="text" name="indent_no" class="form-control" id="indent_no" >
                <input type="hidden" name="chalan_type" value="IndentStockOut">
            </div>

            <div class="form-group col-md-3">
                <label for="indent_date">Indent Date</label>
                <input type="date" name="indent_date" onkeydown="return false" class="form-control" id="indent_date" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>

            <div class="form-group col-md-3">
                <label for="division_id">Office Name (Consignee)</label>
                <select class="form-control select2" id="division_id" name="division_id" required>
                    <option value="" >None</option>
                    @foreach(\App\Models\Division::all() as $division)
                        <option value="{{$division->id}}">{{$division->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="scheme_name">Scheme (Normal/ADP)</label>
                <select class="form-control select2" id="scheme_name" name="scheme_name">
                    <option value="None" selected>None</option>
                    <option value="Normal">Normal</option>
                    <option value="Deposit">Deposit</option>
                    <option value="Development">Development (ADP)</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="approved_by_name">Approved By Name</label>
                <input type="text" name="approved_by_name" onkeydown="return false" class="form-control" id="approved_by_name">
            </div>

            <div class="form-group col-md-3">
                <label for="approved_by_designation">Approved By Designation</label>
                <input type="text" name="approved_by_designation" onkeydown="return false" class="form-control" id="approved_by_designation">
            </div>

            <div class="form-group col-md-3">
                <label for="received_by_name">Received by Name</label>
                <input type="text" name="received_by_name" class="form-control" id="received_by_name">
            </div>

            <div class="form-group col-md-3">
                <label for="received_by_designation">Received by Designation</label>
                <input type="text" name="received_by_designation" class="form-control" id="received_by_designation" >
            </div>

            <div class="form-group col-md-3">
                <label for="attachment_path_1">Attachment</label>
                <input type="file" name="attachment_path_1" class="form-control" id="attachment_path_1">
            </div>

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

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div class="newqual" style="display: none">

        <div class="row">
            <div class="cross col-md-12">
                <a href="javascript:(0);" class="btn btn-danger float-right">Delete</a>
            </div>
            <div class="form-group col-md-6">
                <label for="" class="text-danger">Store Item</label>
                {{--                //product_id[]--}}
                <select class="form-control select2" name="store_item[xcount_replaceable]" required style="width: 100%;">
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

    @section('customFooterScripts')
        <script>
            $(document).ready(function () {
                var traing_count = 1;
                // $('.select2').select2();
                $("form .select2").select2();

                $("body").delegate("#add_more", "click", function () {

                    var training_html = $('.newqual').html();

                    training_html = training_html.replaceAll('xcount_replaceable',traing_count);
                    traing_count++;

                    $('.myrow').append(training_html);
                    // $('.myrow').append(training_html);
                    //
                    // $('.myrow').append($('.newqual').html());
                    // $("form .select2").select2();
                    $("form .select2").select2();
                });
                $("body").delegate(".cross a", "click", function () {
                    $(this).closest(".row").remove();
                    return false;
                });

            });
        </script>
    @endsection
@endsection
