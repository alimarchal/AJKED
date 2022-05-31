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




    <div class="row">
        <div class="table-responsive">
            @if($product->isNotEmpty())
                <form action="{{route('product.index')}}" method="get" class=" d-print-none">
                    <div class="form-row">


                        <div class="form-group col-md-4">
                            <label for="unit">Name of Item</label>
                            <select class="form-control select2" id="unit" name="filter[name]" style="width: 100%">
                                <option value="" selected>None</option>
                                @foreach($product as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="category_id">Category Code</label>
                            <select class="form-control select2" id="category_id" name="filter[category_id]" style="width: 100%">
                                <option value="" selected>None</option>
                                @foreach(\App\Models\Category::all() as $item)
                                    <option value="{{$item->id}}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-success float-right ml-4">Search</button>
                            <a href="{{route('product.index')}}" class="btn btn-outline-danger float-right">Reset</a>
                            <button class="btn btn-primary float-right mr-4" onclick="window.print()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"></path>
                                </svg>  Print
                            </button>
                        </div>
                    </div>
                </form>
                <br>


                <h4 class="h4 mb-4 text-black text-center">Store Item List as of {{\Carbon\Carbon::now()->format('d-m-Y')}}</h4>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">Stock Code</th>
                        <th>Name of Item</th>
                        <th>Unit</th>
                        <th>Category Code</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        {{--                            <th>Quantity</th>--}}

                        <th class="text-center d-print-none">Action</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($product as $si)
                        <tr>
                            <td class="text-center">{{$si->id}}</td>
                            <td>{{$si->name}}</td>
                            <td>{{$si->unit}}</td>
                            <td class="text-center">{{$si->category->name}}</td>
                            <td>
                                @if($si->status)
                                    Active
                                @else
                                    In-Active
                                @endif
                            </td>
                            <td>{{\Carbon\Carbon::parse($si->created_at)->format('d-m-Y')}}</td>
                            <td>{{\Carbon\Carbon::parse($si->updated_at)->format('d-m-Y')}}</td>
                            @canany(['edit','delete'])
                                <td class="text-center d-print-none">
                                    <a href="{{route('product.edit',$si->id)}}" class="btn btn-outline-primary btn-sm" title="Edit Store Item">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            @endcanany

                            {{--                                <td >--}}


                            {{--                                <div class="text-center">--}}
                            {{--                                    <!-- Button trigger modal -->--}}
                            {{--                                    <button type="button" class="btn btn-success" data-toggle="modal"--}}
                            {{--                                            data-target="#exampleModal-{{$loop->iteration}}">--}}
                            {{--                                        Stock In--}}
                            {{--                                    </button>--}}
                            {{--                                </div>--}}

                            {{--                                    <!-- Modal -->--}}
                            {{--                                    <div class="modal fade" id="exampleModal-{{$loop->iteration}}" tabindex="-1"--}}
                            {{--                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                            {{--                                        <div class="modal-dialog modal-dialog-centered" role="document">--}}
                            {{--                                            <div class="modal-content">--}}
                            {{--                                                <div class="modal-header">--}}
                            {{--                                                    <h5 class="modal-title" id="exampleModalLabel">Stock In</h5>--}}
                            {{--                                                    <button type="button" class="close" data-dismiss="modal"--}}
                            {{--                                                            aria-label="Close">--}}
                            {{--                                                        <span aria-hidden="true">&times;</span>--}}
                            {{--                                                    </button>--}}
                            {{--                                                </div>--}}

                            {{--                                                <form method="post" action="{{route('stockInOut.store')}}"--}}
                            {{--                                                      enctype="multipart/form-data">--}}
                            {{--                                                    @csrf--}}
                            {{--                                                    <div class="modal-body">--}}

                            {{--                                                        <input type="hidden" name="product_id" value="{{$si->id}}">--}}
                            {{--                                                        <input type="hidden" name="type" value="In">--}}

                            {{--                                                        <div class="form-row">--}}
                            {{--                                                            <div class="form-group col-md-12">--}}
                            {{--                                                                <label for="supplier_id">Supplier</label>--}}
                            {{--                                                                <select class="form-control" id="supplier_id"--}}
                            {{--                                                                        name="supplier_id" required>--}}
                            {{--                                                                    <option value="">None</option>--}}
                            {{--                                                                    @foreach(\App\Models\Supplier::all() as $item)--}}
                            {{--                                                                        <option value="{{$item->id}}">({{ $item->type }}--}}
                            {{--                                                                            Category: {{$item->category}})--}}
                            {{--                                                                            - {{ $item->description }}</option>--}}
                            {{--                                                                    @endforeach--}}
                            {{--                                                                </select>--}}
                            {{--                                                            </div>--}}


                            {{--                                                            <div class="form-group col-md-6">--}}
                            {{--                                                                <label for="po_no">PO/Indent No</label>--}}
                            {{--                                                                <input type="text" name="po_no"--}}
                            {{--                                                                       max="{{date('Y-m-d')}}" required--}}
                            {{--                                                                       id="po_no"--}}
                            {{--                                                                       class="form-control">--}}
                            {{--                                                            </div>--}}


                            {{--                                                            <div class="form-group col-md-6">--}}
                            {{--                                                                <label for="po_date">PO/Indent Date</label>--}}
                            {{--                                                                <input type="date" name="po_date"--}}
                            {{--                                                                       max="{{date('Y-m-d')}}" required--}}
                            {{--                                                                       id="po_date"--}}
                            {{--                                                                       class="form-control">--}}
                            {{--                                                            </div>--}}


                            {{--                                                            <div class="form-group col-md-6">--}}
                            {{--                                                                <label for="receiving_po_date">Receiving--}}
                            {{--                                                                    Date</label>--}}
                            {{--                                                                <input type="date" name="receiving_po_date"--}}
                            {{--                                                                       max="{{date('Y-m-d')}}" required--}}
                            {{--                                                                       id="receiving_po_date"--}}
                            {{--                                                                       class="form-control">--}}
                            {{--                                                            </div>--}}

                            {{--                                                            <div class="form-group col-md-6">--}}
                            {{--                                                                <label for="quantity">Quantity:</label>--}}
                            {{--                                                                <input type="number" placeholder="0" min="0"--}}
                            {{--                                                                       max="100000000" required step="0.01"--}}
                            {{--                                                                       name="quantity" id="quantity"--}}
                            {{--                                                                       class="form-control">--}}
                            {{--                                                            </div>--}}


                            {{--                                                            <div class="form-group col-md-12">--}}
                            {{--                                                                <label for="description">Description</label>--}}
                            {{--                                                                <textarea class="form-control" id="description"--}}
                            {{--                                                                          name="description" rows="3"></textarea>--}}
                            {{--                                                            </div>--}}


                            {{--                                                            <div class="form-group col-md-12">--}}
                            {{--                                                                <label for="attachment_path">Attachment (If Any)</label>--}}
                            {{--                                                                <input type="file" name="attachment_path_1"--}}
                            {{--                                                                       id="attachment_path" class="form-control-file">--}}
                            {{--                                                            </div>--}}


                            {{--                                                        </div>--}}


                            {{--                                                    </div>--}}
                            {{--                                                    <div class="modal-footer">--}}
                            {{--                                                        <button type="button" class="btn btn-secondary"--}}
                            {{--                                                                data-dismiss="modal">Cancel--}}
                            {{--                                                        </button>--}}
                            {{--                                                        <button type="submit" class="btn btn-success">Save Changes--}}
                            {{--                                                        </button>--}}
                            {{--                                                    </div>--}}


                            {{--                                                </form>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </td>--}}
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @endif
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
