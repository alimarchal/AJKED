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
        Create Purchase Order
    </h4>

    <form method="post" action="{{route('purchaseOrder.store')}}" onsubmit="return confirm('Do you really want to submit the form?');" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
{{--            <div class="form-group col-md-4">--}}
{{--                <label for="purchase_order_id">--}}
{{--                    <abbr title="Purchase Order ID must be unique">Purchase Order ID (POID)</abbr>--}}
{{--                </label>--}}
{{--                <input type="text" name="purchase_order_id" class="form-control" id="purchase_order_id">--}}
{{--            </div>--}}
            <div class="form-group col-md-3">
                <label for="purchase_order_number">PO Number</label>
                <input type="text" name="purchase_order_number" class="form-control" id="purchase_order_number" >
            </div>
            <div class="form-group col-md-3">
                <label for="purchase_order_date">PO Date</label>
                <input type="date" name="purchase_order_date" onkeydown="return false" class="form-control" id="purchase_order_date" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>
            <div class="form-group col-md-3">
                <label for="name_of_firm_supplier">Name of Firm/Supplier</label>
                <select class="form-control select2" id="name_of_firm_supplier" name="name_of_firm_supplier" required>
                    <option value="" >None</option>
                    @foreach(\App\Models\Supplier::where('status','Active')->get() as $supplier)
                        <option value="{{$supplier->id}}">{{$supplier->name_of_supplier_firm}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="reference_number">Reference number</label>
                <input type="number" min="1" step="0.01" name="reference_number" class="form-control" id="reference_number">
            </div>



            <div class="form-group col-md-3">
                <label for="designation">Designation</label>
                <input type="text" name="designation" class="form-control" id="designation">
            </div>

            <div class="form-group col-md-3">
                <label for="attachment_path_1">Attachment</label>
                <input type="file" name="attachment_path_1" class="form-control" id="attachment_path_1">
            </div>
            <div class="form-group col-md-3">
                <label for="status">Status (Running/Completed)</label>
                <select class="form-control select2" id="status" name="status" required>
                    <option value="">None</option>
                    <option value="Running">Running</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

        </div>


        <div class="myrow">

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
                        <option value="{{$item->id}}">{{$item->name}}</option>
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
                var traing_count = 0;
                // $('.select2').select2();


                $("body").delegate("#add_more", "click", function () {

                    var training_html = $('.newqual').html();

                    training_html = training_html.replaceAll('xcount_replaceable',traing_count);
                    traing_count++;

                    $('.myrow').append(training_html);
                    // $('.myrow').append(training_html);
                    //
                    // $('.myrow').append($('.newqual').html());
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
