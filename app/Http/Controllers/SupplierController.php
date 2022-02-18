<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

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
        $type = implode(',', $request->type);
        $request->merge(['type' => $type]);
        $supplier = Supplier::create($request->all());
        session()->flash('success', 'Supplier successfully created.');
        return redirect()->route('supplier.create');
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
        $type = implode(',', $request->type);
        $request->merge(['type' => $type]);
        $supplier->update($request->all());
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
