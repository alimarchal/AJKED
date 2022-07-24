<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function stockReturn(Request $request)
    {

        if ($request->has('month')) {
            $date_from = Carbon::parse($request->month)->firstOfMonth()->format('Y-m-d');
            $date_to = Carbon::parse($request->month)->lastOfMonth()->format('Y-m-d');
            $stock_in_out = DB::table('stock_in_outs')
                ->select(DB::raw('stock_in_outs.division_id, divisions.name, stock_in_outs.product_id, SUM(stock_in_outs.quantity) AS quantity, stock_in_outs.type'))
                ->join('divisions', 'stock_in_outs.division_id', '=', 'divisions.id')
                ->where('stock_in_outs.type', '=', 'Debit')
                ->whereBetween('stock_in_outs.general_date', [$date_from, $date_to])
                ->groupBy(['stock_in_outs.division_id', 'stock_in_outs.product_id'])
                ->get();

            $received_material = DB::table('stock_in_outs')
                ->select(DB::raw('product_id, SUM(quantity) AS quantity'))
                ->where('stock_in_outs.type', '=', 'Credit')
                ->whereBetween('stock_in_outs.general_date', [$date_from, $date_to])
                ->groupBy(['product_id'])
                ->get();


            $total_issued = DB::table('stock_in_outs')
                ->select(DB::raw('product_id, SUM(quantity) AS quantity'))
                ->where('stock_in_outs.type', '=', 'Debit')
                ->whereBetween('stock_in_outs.general_date', [$date_from, $date_to])
                ->groupBy(['product_id'])
                ->get();

            return view('report.stockReturn', compact('stock_in_out', 'date_from','total_issued','received_material'));
        } else {
            $date_from = Carbon::parse(date('Y-m-d'))->firstOfMonth()->format('Y-m-d');
            $date_to = Carbon::parse(date('Y-m-d'))->lastOfMonth()->format('Y-m-d');


            $received_material = DB::table('stock_in_outs')
                ->select(DB::raw('product_id, SUM(quantity) AS quantity'))
                ->where('stock_in_outs.type', '=', 'Credit')
                ->whereBetween('stock_in_outs.general_date', [$date_from, $date_to])
                ->groupBy(['product_id'])
                ->get();



            $total_issued = DB::table('stock_in_outs')
                ->select(DB::raw('product_id, SUM(quantity) AS quantity'))
                ->where('stock_in_outs.type', '=', 'Debit')
                ->whereBetween('stock_in_outs.general_date', [$date_from, $date_to])
                ->groupBy(['product_id'])
                ->get();


            $stock_in_out = DB::table('stock_in_outs')
                ->select(DB::raw('stock_in_outs.division_id, divisions.name, stock_in_outs.product_id, SUM(stock_in_outs.quantity) AS quantity, stock_in_outs.type'))
                ->join('divisions', 'stock_in_outs.division_id', '=', 'divisions.id')
                ->where('stock_in_outs.type', '=', 'Debit')
                ->whereBetween('stock_in_outs.general_date', [$date_from, $date_to])
                ->groupBy(['stock_in_outs.division_id', 'stock_in_outs.product_id'])
                ->get();



            return view('report.stockReturn', compact('stock_in_out', 'date_from','total_issued','received_material','date_to'));
        }
    }
}
