<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Carbon\Carbon;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);

        // $this->middleware(['role:super-admin|admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





     public function index(Request $request)
     {
         $purchases = Purchase::with('supplier', 'material')->latest();

         if ($request->has('start_date') && $request->has('end_date')) {
             $start_date = Carbon::createFromFormat('d/m/Y', $request->input('start_date'))->startOfDay()->format('Y-m-d');
             $end_date = Carbon::createFromFormat('d/m/Y', $request->input('end_date'))->endOfDay()->format('Y-m-d');

             $purchases = $purchases->whereBetween('purchase_date', [$start_date, $end_date]);
         }

         $purchases = $purchases->get();

         return view('dashboard.purchase.index', compact('purchases'));
     }



//      filter data monthwise
//      public function index($month = null)
//      {
//          if($month == null){
//              $month = Carbon::now()->month;
//          }
//          $purchases = Purchase::with('supplier', 'material')->whereMonth('purchase_date', $month)->latest()->get();
//          $current_month = $month;
//          return view('dashboard.purchase.index',compact('purchases','current_month'));
//      }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        // $material = Material
        $supplier = Supplier::all();
        // dd($supplier);
        return view('dashboard.purchase.show', compact('purchase','supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        return view('dashboard.purchase.edit', compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchase.index')->with('status', 'Purchase Invoice has been removed');
    }




}
