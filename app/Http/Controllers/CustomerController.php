<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
      public function __construct()
    {
        // $this->middleware(['role:super-admin|admin']);
        $this->middleware(['auth']);
        // $this->middleware('permission')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('dashboard.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.customer.create');
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
            'customer_name' => ['required', 'string', 'min:3', 'max:255'],
            'customer_image' => ['nullable'],
            'contact_no' => ['nullable', 'string', 'min:3', 'max:255'],
            'email' => ['nullable', 'string', 'min:3', 'max:255'],
            'address' => ['nullable', 'string', 'min:3', 'max:255'],

        ]);
        if($request->has('customer_image')){
            $data['customer_image']  = $request->file('customer_image')->store('images/customers','public');
        }
        $data['slug'] = Str::slug(Carbon::now()->timestamp);
        $customers = Customer::create($data);
        return redirect()->route('customer.edit', $customers)->with('status', 'A New Customer has been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {

        return view('dashboard.customer.show', compact('customer'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        return view('dashboard.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        // dd($request);
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'min:3', 'max:255'],
            'customer_image' => ['nullable'],
            'contact_no' => ['nullable', 'string', 'min:3', 'max:255'],
            'email' => ['nullable', 'string', 'min:3', 'max:255'],
            'address' => ['nullable', 'string', 'min:3', 'max:255'],
        ]);
        if($request->has('customer_image')){
            $data['customer_image']  = $request->file('customer_image')->store('images/customers','public');
        }
        $data['slug'] = Str::slug(Carbon::now()->timestamp);
        $customer->update($data);
        return redirect()->route('customer.index')->with('status', 'A customer has been updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('status', 'A customer has been removed');
    }
}
