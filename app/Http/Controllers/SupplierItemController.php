<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierItemRequest;
use App\Http\Requests\UpdateSupplierItemRequest;
use App\Models\SupplierItem;

class SupplierItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupplierItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierItem  $supplierItem
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierItem $supplierItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierItem  $supplierItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierItem $supplierItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierItemRequest  $request
     * @param  \App\Models\SupplierItem  $supplierItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierItemRequest $request, SupplierItem $supplierItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierItem  $supplierItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierItem $supplierItem)
    {
        //
    }
}
