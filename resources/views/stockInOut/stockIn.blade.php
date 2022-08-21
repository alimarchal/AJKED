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
        Stock In from Purchase Order
    </h4>

    <form method="post" action="{{route('product.stockInStore')}}" onsubmit="return confirm('Do you really want to submit the form?');" enctype="multipart/form-data">
        @csrf
        <div class="form-row">


            <input type="hidden" name="chalan_type" value="PurchaseOrder">
            <div class="form-group col-md-3">
                <label for="purchase_order_id">POID</label>
                <select class="form-control select2" id="purchase_order_id" name="purchase_order_id" required>
                    <option value="" >None</option>
                    @foreach(\App\Models\PurchaseOrder::where('status','Running')->get() as $supplier)
                        <option value="{{$supplier->id}}">{{$supplier->purchase_order_number . ' - ' . \App\Models\Supplier::find($supplier->name_of_firm_supplier)->name_of_supplier_firm }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group col-md-3">
                <label for="delivery_chalan_receiving_date">Delivery Chalan Receiving Date</label>
                <input type="date" name="delivery_chalan_receiving_date" onkeydown="return false" class="form-control" id="delivery_chalan_receiving_date" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>

            <div class="form-group col-md-3">
                <label for="delivery_chalan_number">Delivery Chalan Number</label>
                <input type="text" name="delivery_chalan_number" onkeydown="return false" class="form-control" id="delivery_chalan_number" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>


            <div class="form-group col-md-3">
                <label for="delivery_chalan_date">Delivery Chalan Date</label>
                <input type="date" name="delivery_chalan_date" onkeydown="return false" class="form-control" id="delivery_chalan_date" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>



            <div class="form-group col-md-3">
                <label for="inspection_certification_number">Inspection Certification Number</label>
                <input type="text" name="inspection_certification_number" onkeydown="return false" class="form-control" id="inspection_certification_number" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>


            <div class="form-group col-md-3">
                <label for="inspection_certification_date">Inspection Certification Date</label>
                <input type="date" name="inspection_certification_date" onkeydown="return false" class="form-control" id="inspection_certification_date" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>




            <div class="form-group col-md-3">
                <label for="receiving_person_name">Receiving Person</label>
                <input type="text" name="receiving_person_name" onkeydown="return false" class="form-control" id="receiving_person_name" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>


            <div class="form-group col-md-3">
                <label for="receiving_person_designation">Designation</label>
                <input type="text" name="receiving_person_designation" onkeydown="return false" class="form-control" id="receiving_person_designation" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>


            <div class="form-group col-md-3">
                <label for="from_supplier_person">From (Supplier Person)</label>
                <input type="text" name="from_supplier_person" onkeydown="return false" class="form-control" id="from_supplier_person" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>


            <div class="form-group col-md-3">
                <label for="from_supplier_designation">Designation (Supplier Person)</label>
                <input type="text" name="from_supplier_designation" onkeydown="return false" class="form-control" id="from_supplier_designation" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
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
