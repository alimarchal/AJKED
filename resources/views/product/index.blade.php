@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('customHeaderScripts')
    <!-- Custom styles for this page -->
    {{--    <link href="{{url('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Page Heading -->
    {{--    <h4 class="h4 mb-4 text-gray-800">Store Items</h4>--}}


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Store Items</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($product->isNotEmpty())
                    <form action="{{route('product.index')}}" method="get">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="category_id">Category</label>
                                <select class="form-control select2" id="category_id" name="filter[category_id]" style="width: 100%">
                                    <option value="" selected>None</option>
                                    @foreach(\App\Models\Category::all() as $item)
                                        <option value="{{$item->id}}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="unit">Name</label>
                                <select class="form-control select2" id="unit" name="filter[name]" style="width: 100%">
                                    <option value="" selected>None</option>
                                    @foreach($product as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-success float-right ml-4">Search</button>
                                <a href="{{route('product.index')}}" class="btn btn-outline-danger float-right">Reset</a>
                            </div>


                        </div>
                    </form>
                    <br>
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($product as $si)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$si->category->name}}</td>
                                <td>{{$si->name}}</td>
                                <td>{{$si->unit}}</td>
                                <td>{{$si->quantity}}</td>

                                <td >


                                <div class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#exampleModal-{{$loop->iteration}}">
                                        Stock In
                                    </button>
                                </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal-{{$loop->iteration}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Stock In</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form method="post" action="{{route('stockInOut.store')}}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <input type="hidden" name="product_id" value="{{$si->id}}">
                                                        <input type="hidden" name="type" value="In">

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label for="supplier_id">Supplier</label>
                                                                <select class="form-control" id="supplier_id"
                                                                        name="supplier_id" required>
                                                                    <option value="">None</option>
                                                                    @foreach(\App\Models\Supplier::all() as $item)
                                                                        <option value="{{$item->id}}">({{ $item->type }}
                                                                            Category: {{$item->category}})
                                                                            - {{ $item->description }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>


                                                            <div class="form-group col-md-6">
                                                                <label for="po_no">PO/Indent No</label>
                                                                <input type="text" name="po_no"
                                                                       max="{{date('Y-m-d')}}" required
                                                                       id="po_no"
                                                                       class="form-control">
                                                            </div>


                                                            <div class="form-group col-md-6">
                                                                <label for="po_date">PO/Indent Date</label>
                                                                <input type="date" name="po_date"
                                                                       max="{{date('Y-m-d')}}" required
                                                                       id="po_date"
                                                                       class="form-control">
                                                            </div>


                                                            <div class="form-group col-md-6">
                                                                <label for="receiving_po_date">Receiving
                                                                    Date</label>
                                                                <input type="date" name="receiving_po_date"
                                                                       max="{{date('Y-m-d')}}" required
                                                                       id="receiving_po_date"
                                                                       class="form-control">
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                                <label for="quantity">Quantity:</label>
                                                                <input type="number" placeholder="0" min="0"
                                                                       max="100000000" required step="0.01"
                                                                       name="quantity" id="quantity"
                                                                       class="form-control">
                                                            </div>


                                                            <div class="form-group col-md-12">
                                                                <label for="description">Description</label>
                                                                <textarea class="form-control" id="description"
                                                                          name="description" rows="3"></textarea>
                                                            </div>


                                                            <div class="form-group col-md-12">
                                                                <label for="attachment_path">Attachment (If Any)</label>
                                                                <input type="file" name="attachment_path_1"
                                                                       id="attachment_path" class="form-control-file">
                                                            </div>


                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <button type="submit" class="btn btn-success">Save Changes
                                                        </button>
                                                    </div>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>


@endsection
@section('customFooterScripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
