<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockInOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $data = [];
        $products = Product::all();
        foreach($products as $item)
        {
            $data[$item->id] = ['opening_balance' => 0, 'received_during_month' => 0, 'issue_during_month' => 0, 'present_item' => 0];
        }

        foreach($products as $item)
        {
            $opening_balance = StockInOut::where('product_id', $item->id)->whereBetween('created_at', [\Carbon\Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),\Carbon\Carbon::now()->endOfMonth()->subMonth()->format('Y-m-d 23:59:59'),])->latest()->first();
            $received_during_month = StockInOut::where('product_id',$item->id)->where('type','Credit')->whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')])->get()->sum('quantity');
            $issue_during_month = StockInOut::where('product_id',$item->id)->where('type','Debit')->whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')])->get()->sum('quantity');
            if (!empty($opening_balance))
            {
                $data[$item->id]['opening_balance'] = $opening_balance->balance;
            }

            $data[$item->id]['received_during_month'] = $received_during_month;
            $data[$item->id]['issue_during_month'] = $issue_during_month;
            $data[$item->id]['present_item'] = $item->quantity;
        }
        return view('dashboard',compact('data'));
    }


    public function itemWithDescription()
    {
        $data = [];
        $products = Product::all();
        foreach($products as $item)
        {
            $data[$item->id] = ['opening_balance' => 0, 'received_during_month' => 0, 'issue_during_month' => 0, 'present_item' => 0];
        }

        foreach($products as $item)
        {
            $opening_balance = StockInOut::where('product_id', $item->id)->whereBetween('created_at', [\Carbon\Carbon::now()->startOfMonth()->subMonth()->format('Y-m-d 00:00:00'),\Carbon\Carbon::now()->endOfMonth()->subMonth()->format('Y-m-d 23:59:59'),])->latest()->first();
            $received_during_month = StockInOut::where('product_id',$item->id)->where('type','Credit')->whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')])->get()->sum('quantity');
            $issue_during_month = StockInOut::where('product_id',$item->id)->where('type','Debit')->whereBetween('created_at',[\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d'),\Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')])->get()->sum('quantity');
            if (!empty($opening_balance))
            {
                $data[$item->id]['opening_balance'] = $opening_balance->quantity;
            }

            $data[$item->id]['received_during_month'] = $received_during_month;
            $data[$item->id]['issue_during_month'] = $issue_during_month;
            $data[$item->id]['present_item'] = $item->quantity;
        }
        return view('report.itemWithDescription',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
