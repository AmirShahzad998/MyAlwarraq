<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Material;
use Illuminate\Support\Str;
use App\Models\MaterialType;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaterialController extends Controller
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
        $materials = Material::withCount('types')->withSum('transactions', 'purchase_quantity')
        ->withSum('transactions', 'order_quantity')->latest()->get();
        return view('dashboard.material.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.material.create');
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
            'material_name' => ['required', 'string', 'min:3', 'max:255'],
            'unit_price' => ['nullable', 'numeric'],
            'initial_stock' =>['nullable', 'integer'],
            'initial_stock_date' => ['required'],
            'enable_sheet_size' => ['nullable'],
            'enable_job_order' => ['nullable'],
            'enable_n_a_option' => ['nullable'],

        ]);
        if($request->has('enable_sheet_size')){
            $data['enable_sheet_size'] = true;
        }
        if($request->has('enable_job_order')){
            $data['enable_job_order'] = true;
        }
        if($request->has('enable_n_a_option')){
            $data['enable_n_a_option'] = true;
        }
        $data['slug'] = Str::slug(Carbon::now()->timestamp);

        $material = Material::create($data);
        return redirect()->route('material.edit', $material)->with('status', 'A New material has been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {



        $material = $material->load('transactions.job_order','transactions.purchase','transactions.purchase_detail');
        // dd($material);
        $types = MaterialType::withSum('transactions', 'purchase_quantity')
        ->withSum('transactions', 'order_quantity')
                ->where('material_id', $material->id)->get();

                // $enable_order;
        $supplier = Supplier::all();
    // dd($supplier );
        return view('dashboard.material.show', compact('material','supplier' ,'types'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        return view('dashboard.material.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $data = $request->validate([
            'material_name' => ['required', 'string', 'min:3', 'max:255'],
            'unit_price' => ['nullable', 'string', 'min:3', 'max:255'],
            'initial_stock' => ['nullable', 'integer'],
            'initial_stock_date' => ['required'],
            'enable_sheet_size' => ['nullable'],
            'enable_job_order' => ['nullable'],
            'enable_n_a_option' => ['nullable'],
        ]);
        $data['slug'] = Str::slug($request->material_name);
        $data['enable_sheet_size'] = false;
        $data['enable_job_order'] = false;
        $data['enable_n_a_option'] = false;

        if($request->has('enable_sheet_size')){
            $data['enable_sheet_size'] = true;
        }
        if($request->has('enable_job_order')){
            $data['enable_job_order'] = true;
        }
        if($request->has('enable_n_a_option')){
            $data['enable_n_a_option'] = true;
        }
        $material->update($data);
        return redirect()->route('material.index')->with('status', 'A material has been updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(material $material)
    {
        $material->delete();
        return redirect()->route('material.index')->with('status', 'A material has been removed');
    }
    public function type_store(Request $request)
    {
        $data = $request->validate([
            'material_id' => ['required'],
            'type' => ['required', 'string'],
            'initial_stock_date' => ['required'],
            'unit_price' => ['required','numeric'],
            'initial_stock' => ['nullable', 'integer'],
        ]);
        MaterialType::create($data);
        return back()->with('status', 'A Material Type has been added');


    }
    public function show_type($id)
    {
        $materialType = MaterialType::findOrFail($id);
        $materialType = $materialType->load('material','transactions.job_order','transactions.purchase','transactions.purchase_detail');
        // dd($materialType);
        $types = MaterialType::withSum('transactions', 'purchase_quantity')
        ->withSum('transactions', 'order_quantity')
                ->where('material_id', $materialType->id)->get();

                // $enable_order;

                // dd($types);
        return view('dashboard.material.materialType_show', compact('materialType','types'));
    }
    public function type_delete($id)
    {
        $type = MaterialType::findOrFail($id);
        $type->delete();
        return back()->with('status', 'A Material Type has been removed');
    }
}
