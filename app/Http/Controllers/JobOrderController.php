<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\JobOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class JobOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index($month = null)
    // {
    //     if($month == null){
    //         $month = Carbon::now()->month;
    //     }


    //     $orders = JobOrder::with('customer')->latest()->get();
    //     $current_month = $month;

    //     return view('dashboard.job-order.index',compact('orders'));
    // }

    public function index(Request $request)
    {
        $orders = JobOrder::with('customer')->latest();

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = Carbon::createFromFormat('d/m/Y', $request->input('start_date'))->startOfDay()->format('Y-m-d');
            $end_date = Carbon::createFromFormat('d/m/Y', $request->input('end_date'))->endOfDay()->format('Y-m-d');

            $orders = $orders->whereBetween('order_date', [$start_date, $end_date]);
        }

        $orders = $orders->get();

        return view('dashboard.job-order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $order_no = $this->get_order_no();
        return view('dashboard.job-order.create', compact('customers', 'order_no'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => ['required'],
            'order_no' => ['nullable', 'string',  'max:255' ,'unique:job_orders'],
            'order_date' => ['required', 'string', 'min:3', 'max:255'],
            'order_type' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'quantity' => ['required', 'integer'],
            'total' => ['required', 'numeric'],
        ]);
        JobOrder::create($data);
        return redirect()->route('job-order.index')->with('status', 'A New Job Order has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(JobOrder $jobOrder)
    {
        return view('dashboard.job-order.show', compact('jobOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(JobOrder $jobOrder)
    {
        $customers = Customer::all();

        return view('dashboard.job-order.edit', compact('jobOrder', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobOrder $jobOrder)
    {
        $data = $request->validate([
            'customer_id' => ['required'],
            'order_date' => ['required', 'string', 'min:3', 'max:255'],
            'order_type' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'quantity' => ['required', 'integer'],
            'total' => ['required', 'numeric'],
        ]);
        $jobOrder->update($data);
        return redirect()->route('job-order.index')->with('status', 'A Job Order has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobOrder $jobOrder)
    {
        $jobOrder->delete();
        return redirect()->route('job-order.index')->with('status', 'A Job Order has been removed');

    }
    public function estimate(JobOrder $jobOrder)
    {
        if($jobOrder->active){
            return view('dashboard.job-order.estimate', compact('jobOrder'));

        }
        else{
            abort('403', 'This Job Order is set to In-Active');
        }
    }
    public function actual(JobOrder $jobOrder)
    {
        if($jobOrder->active){
            return view('dashboard.job-order.actual', compact('jobOrder'));
        }
        else{
            abort('403', 'This Job Order is set to In-Active');
        }
    }
    public function get_order_no()
    {
        $check = JobOrder::latest()->first();
        $max = 1;
        if ($check != null) {
            $max = JobOrder::latest('id')->first()->id + 1;
        }
        return "#".$max;
    }
}
