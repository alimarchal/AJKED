<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchemeItemRequest;
use App\Http\Requests\UpdateSchemeItemRequest;
use App\Models\SchemeItem;

class SchemeItemController extends Controller
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
     * @param  \App\Http\Requests\StoreSchemeItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchemeItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchemeItem  $schemeItem
     * @return \Illuminate\Http\Response
     */
    public function show(SchemeItem $schemeItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchemeItem  $schemeItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SchemeItem $schemeItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSchemeItemRequest  $request
     * @param  \App\Models\SchemeItem  $schemeItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchemeItemRequest $request, SchemeItem $schemeItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchemeItem  $schemeItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchemeItem $schemeItem)
    {
        //
    }
}
