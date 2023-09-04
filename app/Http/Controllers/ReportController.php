<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchases\Purchase;
use App\Models\Sales\Sales;
use App\Models\Stock;
use DB;

class ReportController extends Controller
{
    public function purchase_report(Request $r){
        
        $purchases=Purchase::select(
            DB::raw("sum(total_amount) as amt"),
            DB::raw("date(`created_at`) as dt")
        )->groupBy(DB::raw('Date(created_at)'))->get();

        return view('report.purchase_report',compact('purchases'));
    }
    public function stock_report(Request $r){
        $stock=Stock::select(
                DB::raw("sum(quantity) as qty"),
                DB::raw("(select product_name from products where products.id=stocks.product_id) as product")
            )->groupBy('product_id')->get();
        return view('report.stock_report',compact('stock'));
    }
    public function sale_report(Request $r){
        
        $sales=Sales::select(
            DB::raw("sum(total_amount) as amt"),
            DB::raw("date(`created_at`) as dt")
        )->groupBy(DB::raw('Date(created_at)'))->get();

        return view('report.sale_report',compact('sales'));
    }

}
