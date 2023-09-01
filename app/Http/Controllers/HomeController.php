<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\JobOrder;
use App\Models\JobOrderActual;
use App\Models\Material;
use App\Models\Purchase;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = JobOrder::with('customer')->latest()->get();
        $customer_count = Customer::count();
        $supplier_count = Supplier::count();
        $material_count = Material::count();
        $job_order_count = JobOrder::count();


        $current_month_order = JobOrder::whereMonth('created_at', Carbon::now()->month)->get();
        $estimate = [];
        $actual = [];
        $date = [];

        foreach($current_month_order as $index=>$value){
            $estimate[$index]  = $value->total_estimate_cost;
            $actual[$index]  = $value->total_actual_cost;
            $date[$index] = Carbon::parse($value->created_at)->format('Y-m-d');
        }
        $estimate = json_encode($estimate);
        $actual = json_encode($actual);
        $date = json_encode($date);

// dd($actual);

        return view('dashboard.index', compact('orders','job_order_count', 'customer_count', 'supplier_count', 'material_count',
                        'estimate', 'actual', 'date'));
    }
}
