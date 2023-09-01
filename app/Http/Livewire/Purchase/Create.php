<?php

namespace App\Http\Livewire\Purchase;

use Livewire\Component;
use App\Models\Customer;
use App\Models\JobOrder;
use App\Models\JobOrderActual;
use App\Models\Material;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Support\Str;
use App\Models\PurchaseDetail;
use App\Models\MaterialType;
use Carbon\Carbon;

class Create extends Component
{
    public $suppliers;
    public $materials;
    public $material_types;
    public $purchase_materials;
    public $job_orders;
    public $enable_material = false;
    public $enable_order = false;
    public $purchase;

    public $supplier_id;
    public $invoice_no;
    public $purchase_date;


    public $material_id;
    public $material_type_id;
    public $type;
    public $sheet_no;
    public $batch_no;
    public $quantity;
    public $unit_price;
    public $order_no;
    public $total = 0;
    public $grand_total = 0;

    public function mount()
    {
        $this->suppliers = Supplier::all();
        $this->materials = Material::all();
    }
    public function dehydrate()
    {
        $this->dispatchBrowserEvent('render_select2');
    }
    public function render()
    {
        if($this->purchase){
            $this->purchase_materials = PurchaseDetail::where('purchase_id', $this->purchase->id)->get();
            $this->grand_total = PurchaseDetail::where('purchase_id', $this->purchase->id)->sum('total');
        }

        return view('livewire.purchase.create');
    }

    public function store()
    {
        $data = $this->validate([
            'supplier_id' => ['required'],
            'invoice_no' => ['required', 'string'],
            'purchase_date' => ['required'],
        ]);

        $data['slug'] = Carbon::now()->timestamp;
        $data['grand_total'] = $this->grand_total;
        $this->purchase = Purchase::create($data);
        $this->enable_material = true;
    }
    public function add()
    {
        $data = $this->validate([
            'material_id' => ['required'],
            'material_type_id' => ['nullable'],
            'batch_no' => ['nullable', 'string'],
            'quantity' => ['required', 'integer'],
            'unit_price' => ['required', 'numeric'],
        ]);
        $data['total'] = $this->quantity * $this->unit_price;
        $data['purchase_id'] = $this->purchase->id;
        $data['material_name'] = Material::where('id', $this->material_id)->pluck('material_name')->first();
        if($this->material_type_id){
            $data['type'] = MaterialType::where('id', $this->material_type_id)->pluck('type')->first();
        }
        if($this->order_no){
            $data['order_no'] = $this->order_no;
        }
        PurchaseDetail::create($data);

        $this->reset('quantity', 'unit_price', 'material_id', 'material_type_id','type','total');
    }
    public function remove($id)
    {
        $item = PurchaseDetail::findOrFail($id);
        $item->delete();
    }
    public function save_invoice()
    {
        $data['grand_total'] = $this->grand_total;
        $this->purchase->update($data);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'title' => 'Purchase',
            'message' => 'A New Purchase Invoice has been created'
        ]);

        return redirect()->route('purchase.index')->with('status', 'A Purchase Invoice has been created');
    }

    public function updatedMaterialId($value)
    {
        if($value){
            $this->material_id = $value;
            $material= Material::findOrFail($value);
            $this->unit_price = $material->unit_price;
            $this->material_types = MaterialType::where('material_id', $this->material_id)->get();

            if($material->enable_job_order){
                $this->enable_order = true;
                $this->job_orders = JobOrder::all();
            }
            else{
                $this->enable_order = false;
            }
        }
    }
    public function updatedMaterialTypeId($value)
    {
        if($value){
            $this->material_type_id = $value;
            $type= MaterialType::findOrFail($value);
            $this->unit_price = $type->unit_price;

        }
    }
    public function updatedUnitPrice($value)
    {
        if($value){
            $this->total = $this->quantity * $this->unit_price;
        }
    }
    public function updatedQuantity($value)
    {
        if($value){
            $this->total = $this->quantity * $this->unit_price;
        }
    }



    public function add_material()
    {
        $this->open_modal();
    }
    public function open_modal()
    {
        $this->dispatchBrowserEvent('open_material_modal');
    }
    public function close_modal()
    {
        $this->dispatchBrowserEvent('close_material_modal');
    }

}
