<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchemeRequest;
use App\Http\Requests\UpdateSchemeRequest;
use App\Models\Scheme;
use App\Models\SchemeItem;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scheme = QueryBuilder::for(Scheme::class)
            ->allowedFilters([AllowedFilter::exact('id'),'name'])
            ->orderByDesc('id')->get();
        return view('scheme.index', compact('scheme'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scheme.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSchemeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchemeRequest $request)
    {

        $poi = array_combine($request->store_item, $request->quantity);;


        $scheme = Scheme::create($request->all());
        foreach ($poi as $key => $value)
        {
            SchemeItem::create([
                'scheme_id' => $scheme->id,
                'product_id' => $key,
                'quantity' => $value,
            ]);
        }

        session()->flash('success', 'Scheme successfully created.');
        return to_route('scheme.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function show(Scheme $scheme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function edit(Scheme $scheme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSchemeRequest  $request
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchemeRequest $request, Scheme $scheme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scheme $scheme)
    {
        //
    }
}
