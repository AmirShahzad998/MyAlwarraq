<?php

namespace App\Http\Livewire\JobOrder;

use Livewire\Component;
use App\Models\Material;
use App\Models\MaterialType;
use App\Models\JobOrderActual;
use App\Models\MaterialTransaction;
use App\Models\Purchase;
use App\Models\PurchaseDetail;

class Actual extends Component
{
    public $jobOrder;
    public $materials;
    public $material_types;
    public $batches;
    public $actual_materials;
    public $purchaseQuantities;

    public $enable_sheet = false;

    public $material_id;
    public $material_type_id;
    public $type;
    public $material_date;
    public $material_name;
    public $sheet_no;
    public $batch_no;
    public $sheet_quantity;
    public $quantity;
    public $unit_price;
    public $total;

    public $total_actual_cost;


    public function dehydrate()
    {
        $this->dispatchBrowserEvent('render_select2');
    }
    public function mount($jobOrder)
    {
        $this->jobOrder = $jobOrder;
        $this->materials = Material::all();
        $this->actual_materials = $jobOrder->actual_materials;
    }
    public function render()
    {
        $this->actual_materials = JobOrderActual::where('job_order_id', $this->jobOrder->id)->get();
        $this->total_actual_cost = JobOrderActual::where('job_order_id', $this->jobOrder->id)->sum('total');


        return view('livewire.job-order.actual');
    }
    public function store()
    {
        $this->jobOrder->update([
            'total_actual_cost' => $this->total_actual_cost
        ]);
        return redirect()->route('job-order.index')->with('status', 'Job Order actual has been created');
    }
    public function add()
    {

        $data = $this->validate([
            'material_id' => ['required'],
            'material_type_id' => ['nullable'],
            'material_date' => ['required'],
            'sheet_no' => ['nullable'],
            'sheet_quantity' => ['nullable','numeric'],
            'batch_no' => ['nullable', 'string'],
            'quantity' => ['required', 'integer'],
            'unit_price' => ['required', 'numeric'],
        ]);
        $data['total'] = $this->quantity * $this->unit_price;
        $data['job_order_id'] = $this->jobOrder->id;
        $data['material_name'] = Material::where('id', $this->material_id)->pluck('material_name')->first();
        if ($this->material_type_id) {
            $data['type'] = MaterialType::where('id', $this->material_type_id)->pluck('type')->first();
        }
        $material = Material::findOrFail($this->material_id);
        if ($material->enable_job_order) {
            if (PurchaseDetail::where('order_no', $this->jobOrder->order_no)->where('material_id', $this->material_id)->exists()) {
                $this->add_data($data);
            } else {
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'error',
                    'title' => 'Error',
                    'message' => 'This Material has not been Purchased'
                ]);
            }
        } else {
            $this->add_data($data);
        }

        // dd($data);
    }
    public function add_data($data)
    {
        JobOrderActual::create($data);

        $this->jobOrder->update([
            'total_actual_cost' => $this->total_actual_cost
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
        $item = JobOrderActual::findOrFail($id);
        $item->delete();
    }


    public function reset_form()
    {
        $this->reset('material_id','material_type_id', 'quantity', 'material_date', 'sheet_no', 'batch_no', 'sheet_quantity', 'unit_price', 'total');
    }

    public function updatedSheetNo($value)
    {
        if ($value) {
            if ($this->sheet_quantity) {
                $this->quantity = intval(($value * $this->sheet_quantity) / 100);
                $this->total = $this->quantity * $this->unit_price;
            }
        }
    }
    public function updatedSheetQuantity($value)
    {
        if ($value) {
            if ($this->sheet_no) {
                $this->quantity =  intval(($value * $this->sheet_no) / 100);
                $this->total = $this->quantity * $this->unit_price;
            }
        }
    }
    public function updatedMaterialId($value)
    {

        if ($value) {
            $material = Material::findOrFail($value);
            $this->unit_price = $material->unit_price;
            $this->material_types = MaterialType::where('material_id', $this->material_id)->get();

            $purchaseQuantities = MaterialTransaction::where('material_id', $this->material_id)->pluck('purchase_quantity');
            $totalPurchaseQuantity = $purchaseQuantities->sum();

            $jobOrderQuantities = JobOrderActual::where('material_id', $this->material_id)->pluck('quantity');
            $totalJobOrderQuantity = $jobOrderQuantities->sum();

            $availableQuantity = $totalPurchaseQuantity - $totalJobOrderQuantity;

            if ($availableQuantity - $this->quantity > 0) {
                $this->batches = MaterialTransaction::where('material_id', $this->material_id)
                    ->where('purchase_quantity', '>', 0)
                    ->groupBy('batch_no')
                    ->get();
            }



            // $this->batches = MaterialTransaction::where('material_id', $this->material_id)->groupBy('batch_no')->get();
            // dd($this->batches);

            if ($material->enable_sheet_size) {
                $this->enable_sheet = true;
            } else {
                $this->enable_sheet = false;
            }
        }
    }
    public function updatedMaterialTypeId($value)
    {
        if ($value) {
            $this->material_type_id = $value;
            $type = MaterialType::findOrFail($value);
            $this->unit_price = $type->unit_price;

            $purchaseQuantities = MaterialTransaction::where('material_id', $this->material_id)->pluck('purchase_quantity');
            $totalPurchaseQuantity = $purchaseQuantities->sum();

            $jobOrderQuantities = JobOrderActual::where('material_id', $this->material_id)->pluck('quantity');
            $totalJobOrderQuantity = $jobOrderQuantities->sum();

            $availableQuantity = $totalPurchaseQuantity - $totalJobOrderQuantity;

            if ($availableQuantity - $this->quantity > 0) {
                $this->batches = MaterialTransaction::where('material_id', $this->material_id)->where('material_type_id', $this->material_type_id)
                    ->where('purchase_quantity', '>', 0)
                    ->groupBy('batch_no')
                    ->get();
            }


            // $this->batches = MaterialTransaction::where('material_id', $this->material_id)
            //     ->where('material_type_id', $this->material_type_id)->groupBy('batch_no')->get();
        }
    }
    public function updatedBatchNo($value)
    {
        if ($value) {
            $material = PurchaseDetail::where('material_id', $this->material_id)
                ->where('material_type_id', $this->material_type_id)
                ->where('batch_no', $this->batch_no)->first();

            $this->unit_price = $material->unit_price;
        }
    }
    public function updatedUnitPrice($value)
    {
        if ($value) {
            $this->total = $this->quantity * $this->unit_price;
        }
    }
    public function updatedQuantity($value)
    {
        if ($value) {
            $this->total = $this->quantity * $this->unit_price;
        }
    }
}
