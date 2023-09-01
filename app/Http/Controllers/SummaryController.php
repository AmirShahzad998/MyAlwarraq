<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\Material;
use App\Models\MaterialType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MaterialTransaction;
use App\Models\Purchase;
use Carbon\Carbon;

class SummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

        // $this->middleware(['role:super-admin|admin']);
    }

    public function index(Request $request)
    {

        $total_materials = MaterialTransaction::with('material')->select('*', DB::raw('sum(purchase_quantity) - sum(order_quantity) as available_unit'), DB::raw('unit_price * (sum(purchase_quantity) - sum(order_quantity)) as stock_value'))
            ->groupBy('material_id', 'material_type_id', 'batch_no')->get();

        $total_purchase = Purchase::sum('grand_total');
        $total_estimate = JobOrder::sum('total_estimate_cost');
        $total_actual = JobOrder::sum('total_actual_cost');

        $total = $total_materials->sum('stock_value');

        //Month Wise

        $monthly_materials = MaterialTransaction::with('material', 'material_type')->select('*', DB::raw('sum(purchase_quantity) - sum(order_quantity) as available_unit'), DB::raw('unit_price * (sum(purchase_quantity) - sum(order_quantity)) as stock_value'))
        ->groupBy('material_id', 'material_type_id', 'batch_no')->latest();

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = Carbon::createFromFormat('d/m/Y', $request->input('start_date'))->startOfDay()->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', $request->input('end_date'))->endOfDay()->format('Y-m-d');

            $monthly_materials = $monthly_materials->whereBetween('date', [$start_date, $end_date]);
            $total_purchase_month = Purchase::whereMonth('purchase_date', $month = Carbon::now()->month)->sum('grand_total');
        $total_estimate_month = JobOrder::whereMonth('order_date', $month = Carbon::now()->month)->sum('total_estimate_cost');
        $total_actual_month = JobOrder::whereMonth('order_date', $month = Carbon::now()->month)->sum('total_actual_cost');

        $total_month = $monthly_materials->sum('stock_value');
        $current_month = $month;
    }

        $monthly_materials = $monthly_materials->get();

        $total_purchase_month = Purchase::whereMonth('purchase_date', $month = Carbon::now()->month)->sum('grand_total');
        $total_estimate_month = JobOrder::whereMonth('order_date', $month = Carbon::now()->month)->sum('total_estimate_cost');
        $total_actual_month = JobOrder::whereMonth('order_date', $month = Carbon::now()->month)->sum('total_actual_cost');

        // $total_purchase_month = Purchase::sum('grand_total');
        // $total_estimate_month = JobOrder::whereMonth('order_date', $month = Carbon::now()->month)->sum('total_estimate_cost');
        // $total_actual_month = JobOrder::whereMonth('order_date', $month = Carbon::now()->month)->sum('total_actual_cost');

        $total_month = $monthly_materials->sum('stock_value');
        $current_month = $month;


        return view('dashboard.summary.index', compact(
            'total_materials',
            'total_purchase',
            'total_estimate',
            'total_actual',
            'total',
            'monthly_materials',
            'total_purchase_month',
            'total_estimate_month',
            'total_actual_month',
            'total_month',
            'current_month'
        ));
    }
}
