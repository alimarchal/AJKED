<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierItem;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\DB;


class SupplierController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:create')->only('create');
        $this->middleware('permission:show')->only('index');
        $this->middleware('permission:edit')->only('edit');
        $this->middleware('permission:delete')->only('destroy');
    }

    public function index()
    {
        $suppliers = QueryBuilder::for(Supplier::class)
            ->allowedFilters(['type', 'category', 'description', 'status', AllowedFilter::exact('id')])
            ->get();
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $unique_category = \App\Models\Supplier::distinct('category')->pluck('category');
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSupplierRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {


        DB::beginTransaction();

        try {
            $supplier = Supplier::create($request->all());
            $supplier_id = $supplier->id;
            foreach($request->product_id as $product)
            {
                $product_item = Product::find($product);
                $supplier_item = SupplierItem::create([
                    'supplier_id' => $supplier_id,
                    'product_id' =>  $product_item->id,
                    'category_id' => $product_item->category_id,
                ]);
            }

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            session()->flash('success', 'Something went wrong.');
            return redirect()->route('supplier.create');
        }


        session()->flash('success', 'Supplier successfully created.');
        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $type = explode(',', $supplier->type);
        return view('suppliers.edit', compact('supplier', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSupplierRequest $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {

        // update supplier table
        // $supplier->update($request->all());

//        dd($request->all());
        DB::beginTransaction();
        try {

            $supplier->update($request->all());
            foreach($supplier->supplier_items as $sup_item)
            {
                $sup_item->delete();
            }

            $supplier_id = $supplier->id;
            foreach($request->product_id as $product)
            {
                $product_item = Product::find($product);
                $supplier_item = SupplierItem::create([
                    'supplier_id' => $supplier_id,
                    'product_id' =>  $product_item->id,
                    'category_id' => $product_item->category_id,
                ]);
            }

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            session()->flash('success', 'Something went wrong.');
            return redirect()->route('supplier.index');
        }
        
        session()->flash('success', 'Supplier successfully updated.');
        return redirect()->route('supplier.edit', [$supplier->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
