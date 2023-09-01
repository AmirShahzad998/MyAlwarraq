<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return view('dashboard.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $data = $request->validate([
            'supplier_name' => ['required', 'string', 'min:3', 'max:255'],
            'supplier_image' => ['nullable'],
            'contact_no' => ['nullable', 'string', 'min:3', 'max:255'],
            'email' => ['nullable', 'string', 'min:3', 'max:255'],
            'address' => ['nullable', 'string', 'min:3', 'max:255'],

        ]);
        if($request->has('supplier_image')){
            $data['supplier_image']  = $request->file('supplier_image')->store('images/suppliers','public');
        }
        $data['slug'] = Str::slug(Carbon::now()->timestamp);
        $suppliers = Supplier::create($data);
        return redirect()->route('supplier.index', $suppliers)->with('status', 'A New supplier has been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {

        return view('dashboard.supplier.show', compact('supplier'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('dashboard.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'supplier_name' => ['required', 'string', 'min:3', 'max:255'],
            'supplier_image' => ['nullable'],
            'contact_no' => ['nullable', 'string', 'min:3', 'max:255'],
            'email' => ['nullable', 'string', 'min:3', 'max:255'],
            'address' => ['nullable', 'string', 'min:3', 'max:255'],
        ]);
        if($request->has('supplier_image')){
            $data['supplier_image']  = $request->file('supplier_image')->store('images/suppliers','public');
        }
        $data['slug'] = Str::slug(Carbon::now()->timestamp);
        $supplier->update($data);
        return redirect()->route('supplier.index')->with('status', 'A supplier has been updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index')->with('status', 'A supplier has been removed');
    }
}
