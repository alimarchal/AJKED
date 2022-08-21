<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use App\Models\Division;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create')->only('create');
        $this->middleware('permission:show')->only('index');
        $this->middleware('permission:edit')->only('edit');
        $this->middleware('permission:delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrder = QueryBuilder::for(PurchaseOrder::class)
            ->allowedFilters([AllowedFilter::exact('id'),'name'])
            ->orderByDesc('id')->get();
        return view('purchaseOrder.index', compact('purchaseOrder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('purchaseOrder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseOrderRequest $request)
    {

        $poi = array_combine($request->store_item, $request->quantity);;

        if ($request->has('attachment_path_1')) {
            $path = $request->file('attachment_path_1')->store('', 'public');
            $request->merge(['attachment' => $path]);
        }

        $purchase_order = PurchaseOrder::create($request->all());
        foreach ($poi as $key => $value)
        {
            PurchaseOrderItem::create([
                'purchase_order_id' => $purchase_order->id,
                'product_id' => $key,
                'quantity' => $value,
            ]);
        }

        session()->flash('success', 'PO successfully created.');
        return to_route('purchaseOrder.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseOrderRequest  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }
}
