<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreItemRequest;
use App\Http\Requests\UpdateStoreItemRequest;
use App\Models\StoreItem;
use Spatie\QueryBuilder\QueryBuilder;

class StoreItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeItems = QueryBuilder::for(StoreItem::class)
            ->allowedFilters('category', 'name', 'unit')
            ->get();
        return view('storeItem.index', compact('storeItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storeitem.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreItemRequest $request)
    {
        $storeItem = StoreItem::create($request->all());
        session()->flash('success', 'Store item successfully created.');
        return redirect()->route('storeItem.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StoreItem  $storeItem
     * @return \Illuminate\Http\Response
     */
    public function show(StoreItem $storeItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StoreItem  $storeItem
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreItem $storeItem)
    {
        return view('storeitem.edit', compact('storeItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreItemRequest  $request
     * @param  \App\Models\StoreItem  $storeItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreItemRequest $request, StoreItem $storeItem)
    {
        $storeItem->update($request->all());
        session()->flash('success', 'Store item successfully updated.');
        return redirect()->route('storeItem.edit',[$storeItem->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoreItem  $storeItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreItem $storeItem)
    {
        //
    }
}
