<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockInOutRequest;
use App\Http\Requests\UpdateStockInOutRequest;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\StockInOut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use function PHPUnit\Framework\throwException;

class StockInOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockInOut = QueryBuilder::for(StockInOut::class)
            ->allowedFilters('product_id', 'division_id', 'supplier_id', 'quantity', 'price', 'type', 'return', 'issued_date', 'return_date')
            ->orderByDesc('created_at')
            ->paginate(10)->withQueryString();
        return view('stockInOut.index', compact('stockInOut'));
    }


    public function stockInDeliveryChalan(Request $request)
    {
        return view('stockInOut.stockIn');
    }


    public function stockInReceivingIndent(Request $request)
    {
        return view('stockInOut.stockInReceivingIndent');
    }

    public function stockInStore(Request $request)
    {

        $product_quantity = array_combine($request->store_item, $request->quantity);
        $flag = false;

        if ($request->chalan_type == "PurchaseOrder") {
            try {
                DB::beginTransaction();
                foreach ($product_quantity as $key => $value) {
                    // Find purchase order number and their product
                    $purchase_order_items = PurchaseOrder::find($request->purchase_order_id)->purchase_order_items;

                    if (!empty($purchase_order_items->where('product_id', $key)->first())) {

                        $purchase_order_item = $purchase_order_items->where('product_id', $key)->first();


                        $balance = $purchase_order_item->balance;

                        $purchase_order_item->update([
                            'balance' => $balance + $value,
                        ]);

                        if ($request->hasFile('attachment_path_1')) {
                            $path = $request->file('attachment_path_1')->store('', 'public');
                            $request->merge(['attachment_path' => $path]);
                        }

                        $stock_in = StockInOut::create([
                            'product_id' => $key,
                            'chalan_type' => $request->chalan_type,
                            'purchase_order_id' => $request->purchase_order_id,
                            'delivery_chalan_receiving_date' => $request->delivery_chalan_receiving_date,
                            'delivery_chalan_number' => $request->delivery_chalan_number,
                            'delivery_chalan_date' => $request->delivery_chalan_date,
                            'inspection_certification_number' => $request->inspection_certification_number,
                            'inspection_certification_date' => $request->inspection_certification_date,
                            'receiving_person_name' => $request->receiving_person_name,
                            'receiving_person_designation' => $request->receiving_person_designation,
                            'from_supplier_person' => $request->from_supplier_person,
                            'from_supplier_designation' => $request->from_supplier_designation,
                            'quantity' => $value,
                            'attachment_path' => $request->attachment_path,
                        ]);

                        $stock_item = Product::find($key);
                        $item_quantity = $stock_item->quantity + $value;
                        $stock_item->update(['quantity' => $item_quantity]);
                        $stock_in->update(['balance' => $item_quantity]);

                    } else {
                        throw new \Exception();
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $flag = true;
            }

            if ($flag) {
                session()->flash('error', 'Error something went wrong!. Your Purchase Order no does not match with submit store item and quantity input please check and retry.');
                return to_route('product.stockInDeliveryChalan');
            } else {
                session()->flash('success', 'Your stock has been successfully updated...');
                return to_route('product.stockInDeliveryChalan');
            }
        } elseif ($request->chalan_type == "Indent") {

            try {
                DB::beginTransaction();
                foreach ($product_quantity as $key => $value) {
                    if ($request->hasFile('attachment_path_1')) {
                        $path = $request->file('attachment_path_1')->store('', 'public');
                        $request->merge(['attachment_path' => $path]);
                    }
                    $stock_in = StockInOut::create([
                        'product_id' => $key,
                        'chalan_type' => $request->chalan_type,
                        'indent_no' => $request->indent_no,
                        'indent_date' => $request->indent_date,
                        'division_id' => $request->division_id,
                        'scheme_name' => $request->scheme_name,
                        'approved_by_name' => $request->approved_by_name,
                        'approved_by_designation' => $request->approved_by_designation,
                        'received_by_name' => $request->received_by_name,
                        'received_by_designation' => $request->received_by_designation,
                        'quantity' => $value,
                        'attachment_path' => $request->attachment_path,
                    ]);
                    $stock_item = Product::find($key);
                    $item_quantity = $stock_item->quantity + $value;
                    $stock_item->update(['quantity' => $item_quantity]);
                    $stock_in->update(['balance' => $item_quantity]);
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $flag = true;
            }

            if ($flag) {
                session()->flash('error', 'Error something went wrong!. Your Purchase Order no does not match with submit store item and quantity input please check and retry.');
                return to_route('product.stockInReceivingIndent');
            } else {
                session()->flash('success', 'Your stock has been successfully updated...');
                return to_route('product.stockInReceivingIndent');
            }

        }


    }

    public function stockOutIndent(Request $request)
    {
        return view('stockOut.stockOutIndent');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function stockOut()
    {
        $product = QueryBuilder::for(Product::class)
            ->allowedFilters([AllowedFilter::exact('category_id'), 'name', 'unit', 'quantity',])
            ->get();
        return view('product.stockOut', compact('product'));
    }


    public function stockOutStore(Request $request)
    {
        $product_quantity = array_combine($request->store_item, $request->quantity);
        $flag = false;
//        dd($request->all());

        try {
            DB::beginTransaction();
            foreach ($product_quantity as $prod => $quan) {
                $remaining_quantity = 0;
                $product = Product::find($prod);
                if ($quan > $product->quantity) {
                    session()->flash('error', 'Quantity is greater then the available quantity.');
                    return redirect()->route('product.stockOut');
                } else {
                    $remaining_quantity = $product->quantity - $quan;
                    $product->quantity = $product->quantity - $quan;
                    $product->save();

                }
                $stockInOut = StockInOut::create([
                    'indent_no' => $request->indent_no,
                    'chalan_type' => $request->chalan_type,
                    'indent_date' => $request->indent_date,
                    'division_id' => $request->division_id,
                    'scheme_name' => $request->scheme_name,
                    'approved_by_name' => $request->approved_by_name,
                    'approved_by_designation' => $request->approved_by_designation,
                    'received_by_name' => $request->received_by_name,
                    'received_by_designation' => $request->received_by_designation,
                    'product_id' => $prod,
                    'quantity' => $quan,
                    'balance' => $remaining_quantity,
                    'type' => 'Debit',
                ]);
            }
            $flag = true;
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        if ($flag) {
            session()->flash('success', 'Stock out successfully.');
            return redirect()->route('product.stockOut');
        } else {
            session()->flash('error', 'Error something went wrong.');
            return redirect()->route('product.stockOut');
        }
    }


    public function stockOutRegister(Request $request)
    {


        if ($request->input('date_range') || $request->input('division_id')) {

            $datetime1 = null;
            $datetime2 = null;

            if (isset($request->date_range) && !empty($request->date_range)) {
                $dates = explode(' – ', $request->date_range);
                $fdate = @$dates[0];
                $tdate = @$dates[1];
                if (!empty($fdate) && !empty($tdate)) {
                    $datetime1 = new \DateTime($fdate);
                    $datetime2 = new \DateTime($tdate);
                }
            }

            $date_from = null;
            $date_to = null;

            if (!empty($request->input('date_range'))) {
                $date_from = $datetime1->format('Y-m-d');
                $date_to = $datetime2->format('Y-m-d');
            } else {
                $date_from = Carbon::parse($request->month)->firstOfMonth()->format('Y-m-d');
                $date_to = Carbon::parse($request->month)->lastOfMonth()->format('Y-m-d');
            }


            if (!empty($request->input('division_id'))) {
                $stock_in_out = DB::table('stock_in_outs')
                    ->select(DB::raw('product_id, division_id, SUM(quantity) AS quantity, previous_quantity, indent_no, indent_date, type, divisions.name'))
                    ->leftJoin('divisions', 'stock_in_outs.division_id', '=', 'divisions.id')
                    ->where('type', '=', 'Out')
                    ->where('division_id', $request->division_id)
                    ->whereBetween('indent_date', [$date_from, $date_to])
                    ->groupBy(['indent_no', 'stock_in_outs.product_id'])
                    ->orderBy('indent_no')
                    ->get();
            } else {
                $stock_in_out = DB::table('stock_in_outs')
                    ->select(DB::raw('product_id, division_id, SUM(quantity) AS quantity, previous_quantity, indent_no, indent_date, type, divisions.name'))
                    ->leftJoin('divisions', 'stock_in_outs.division_id', '=', 'divisions.id')
                    ->where('type', '=', 'Out')
                    ->whereBetween('indent_date', [$date_from, $date_to])
                    ->groupBy(['indent_no', 'stock_in_outs.product_id'])
                    ->orderBy('indent_no')
                    ->get();
            }


            $data = [];

            foreach ($stock_in_out as $si) {
                $data[$si->indent_no][$si->indent_date][$si->name][] = $si;
            }

            return view('product.stockInRegister', compact('data', 'stock_in_out', 'date_from'));
        } else {
            $date_from = Carbon::parse(date('Y-m-d'))->firstOfMonth()->format('Y-m-d');
            $date_to = Carbon::parse(date('Y-m-d'))->lastOfMonth()->format('Y-m-d');


            $stock_in_out = DB::table('stock_in_outs')
                ->select(DB::raw('product_id, division_id, SUM(quantity) AS quantity, previous_quantity, indent_no, indent_date, type, divisions.name'))
                ->leftJoin('divisions', 'stock_in_outs.division_id', '=', 'divisions.id')
                ->where('type', '=', 'Out')
                ->whereBetween('indent_date', [$date_from, $date_to])
//            ->groupBy(['divisions.name','stock_in_outs.product_id','indent_date'])
                ->groupBy(['indent_no', 'stock_in_outs.product_id'])
                ->orderBy('indent_no')
                ->get();

            $data = [];


            foreach ($stock_in_out as $si) {
                $data[$si->indent_no][$si->indent_date][$si->name][] = $si;
            }

            return view('product.stockInRegister', compact('data', 'stock_in_out', 'date_from'));
        }


    }

    public function stockInRegister(Request $request)
    {


        if ($request->has('month')) {
            $date_from = Carbon::parse($request->month)->firstOfMonth()->format('Y-m-d');
            $date_to = Carbon::parse($request->month)->lastOfMonth()->format('Y-m-d');

            $stock_in_out = DB::table('stock_in_outs')
                ->select(DB::raw('stock_in_outs.product_id, stock_in_outs.supplier_id, suppliers.description, stock_in_outs.po_no, stock_in_outs.po_date, stock_in_outs.receiving_po_date, stock_in_outs.quantity, stock_in_outs.type'))
                ->join('suppliers', 'stock_in_outs.supplier_id', '=', 'suppliers.id')
                ->where('stock_in_outs.type', '=', 'In')
                ->whereBetween('stock_in_outs.po_date', [$date_from, $date_to])
                ->groupBy(['stock_in_outs.po_no', 'stock_in_outs.product_id'])
                ->get();

            $data = [];

            foreach ($stock_in_out as $si) {
                $data[$si->po_no][$si->receiving_po_date][$si->description][] = $si;
            }

            return view('product.stockOutRegister', compact('data', 'stock_in_out', 'date_from'));
        } else {
            $date_from = Carbon::parse(date('Y-m-d'))->firstOfMonth()->format('Y-m-d');
            $date_to = Carbon::parse(date('Y-m-d'))->lastOfMonth()->format('Y-m-d');

            DB::enableQueryLog();
            $stock_in_out = DB::table('stock_in_outs')
                ->select(DB::raw('stock_in_outs.product_id, stock_in_outs.supplier_id, suppliers.description,
                stock_in_outs.po_no, stock_in_outs.po_date, stock_in_outs.receiving_po_date, stock_in_outs.quantity, stock_in_outs.type'))
                ->join('suppliers', 'stock_in_outs.supplier_id', '=', 'suppliers.id')
                ->where('stock_in_outs.type', '=', 'In')
                ->whereBetween('stock_in_outs.receiving_po_date', [$date_from, $date_to])
                ->groupBy(['stock_in_outs.po_no', 'stock_in_outs.product_id'])
                ->get();
//            dd(DB::getQueryLog());


            $data = [];

            foreach ($stock_in_out as $si) {
                $data[$si->po_no][$si->receiving_po_date][$si->description][] = $si;
            }

//            dd($data);
            return view('product.stockOutRegister', compact('data', 'stock_in_out', 'date_from'));
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreStockInOutRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockInOutRequest $request)
    {
        $product = Product::find($request->product_id);
        $flag = false;

        if ($request->type == "Out") {

            if ($request->quantity > $product->quantity) {
                session()->flash('error', 'Your quantity is greater then the available.');
                return redirect()->route('product.index');
            }
        }

        try {
            DB::beginTransaction();
            $request->merge(['previous_quantity' => $product->quantity]);
            if ($request->type == "Out") {
                $product->quantity = $product->quantity - $request->quantity;
                $product->save();
            } elseif ($request->type == "In") {
                $product->quantity = $product->quantity + $request->quantity;
                $product->save();
            }

            if ($request->has('attachment_path_1')) {
                $path = $request->file('attachment_path_1')->store('', 'public');
                $request->merge(['attachment_path' => $path]);
            }

            $stockInOut = StockInOut::create($request->all());
            $flag = true;
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        if ($flag) {
            session()->flash('success', 'Store item updated.');
            return redirect()->route('product.index');
        } else {
            session()->flash('error', 'Error something went wrong.');
            return redirect()->route('product.index');
        }

    }
}
