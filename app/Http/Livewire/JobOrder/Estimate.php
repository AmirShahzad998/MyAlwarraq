<?php

namespace App\Http\Livewire\JobOrder;

use Livewire\Component;
use App\Models\Material;
use App\Models\Purchase;
use App\Models\MaterialType;
use App\Models\PurchaseDetail;
use App\Models\JobOrderEstimate;

class Estimate extends Component
{
    public $jobOrder;
    public $materials;
    public $material_types;
    public $material_date;
    public $estimated_materials;

    public $enable_sheet = false;

    public $material_id;
    public $material_type_id;
    public $sheet_no;
    public $sheet_quantity;
    public $quantity;
    public $unit_price;
    public $total;

    public $total_estimate_cost;


    public function dehydrate()
    {
        $this->dispatchBrowserEvent('render_select2');
    }
    public function mount($jobOrder)
    {
        $this->jobOrder = $jobOrder;
        $this->materials = Material::all();
        $this->estimated_materials = $jobOrder->estimated_material;
    }
    public function render()
    {
        $this->estimated_materials = JobOrderEstimate::where('job_order_id', $this->jobOrder->id)->get();
        $this->total_estimate_cost = JobOrderEstimate::where('job_order_id', $this->jobOrder->id)->sum('total');


        return view('livewire.job-order.estimate');
    }
    public function store()
    {
        $this->jobOrder->update([
            'total_estimate_cost' => $this->total_estimate_cost
        ]);
        return redirect()->route('job-order.index')->with('status', 'Job Order Estimate has been created');
    }
    public function add()
    {
        $data = $this->validate([
            'material_id' => ['required'],
            'material_type_id' => ['nullable'],
            'material_date' => ['nullable'],
            'sheet_no' => ['nullable'],
            'sheet_quantity' => ['nullable', 'integer'],
            'quantity' => [ 'integer'],
            'unit_price' => ['required'],
        ]);
        $data['total'] = $this->quantity * $this->unit_price;
        $data['job_order_id'] = $this->jobOrder->id;
        $data['material_name'] = Material::where('id', $this->material_id)->pluck('material_name')->first();
        if($this->material_type_id){
            $data['type'] = MaterialType::where('id', $this->material_type_id)->pluck('type')->first();
        }
        $material= Material::findOrFail($this->material_id);
            $this->add_data($data);

    }
    public function add_data($data)
    {
        JobOrderEstimate::create($data);

        $this->jobOrder->update([
            'total_estimate_cost' => $this->total_estimate_cost
        ]);
        $this->reset('material_id', 'material_type_id', 'quantity', 'sheet_no', 'sheet_quantity', 'unit_price', 'total');

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'title' => 'Estimate',
            'message' => 'A New Material has been Added'
        ]);
    }
    public function remove($id)
    {
        $item = JobOrderEstimate::findOrFail($id);
        $item->delete();
    }


    public function reset_form()
    {
        $this->reset('material_id', 'quantity','material_date', 'sheet_no', 'sheet_quantity', 'unit_price', 'total');
    }
    public function updatedSheetNo($value)
    {
        if($value){
            if($this->sheet_quantity){
                $this->quantity = intval(($value*$this->sheet_quantity)/100);
                $this->total = $this->quantity*$this->unit_price;
            }
        }
    }
    public function updatedSheetQuantity($value)
    {
        if($value){
            if($this->sheet_no){
                $this->quantity =  intval(($value*$this->sheet_no)/100);
                $this->total = $this->quantity*$this->unit_price;
            }
        }
    }
    public function updatedMaterialId($value)
    {
        if($value){
            $material= Material::findOrFail($value);
            // $this->unit_price = $material->unit_price;
            $this->material_types = MaterialType::where('material_id', $this->material_id)->get();

            if($material->enable_sheet_size){
                $this->enable_sheet = true;
            }
            else{
                $this->enable_sheet = false;

            }
        }
    }
    public function updatedMaterialTypeId($value)
    {
        if($value){
            $this->material_type_id = $value;
            $type= MaterialType::findOrFail($value);
            // $this->unit_price = $type->unit_price;

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
}
