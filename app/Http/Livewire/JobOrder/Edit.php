<?php

namespace App\Http\Livewire\JobOrder;

use Livewire\Component;
use App\Models\Customer;
use App\Models\JobOrder;
use Illuminate\Support\Str;

use App\Models\MaterialTransaction;

class Edit extends Component
{
    public $customers;
    public $jobOrder;

    public $customer_id;
    public $order_no;
    public $order_date;
    public $order_type;
    public $description;
    public $quantity;
    public $unit_price;
    public $total = 0;
    public $active = 0;

    public function mount($jobOrder)
    {
        $this->jobOrder = $jobOrder;
        $this->customer_id = $jobOrder->customer_id;
        $this->order_no = $jobOrder->order_no;
        $this->order_date = $jobOrder->order_date;
        $this->order_type = $jobOrder->order_type;
        $this->description = $jobOrder->description;
        $this->quantity = $jobOrder->quantity;
        $this->unit_price = $jobOrder->unit_price;
        $this->total = $jobOrder->total;
        $this->active = $jobOrder->active;

        $this->customers = Customer::all();
    }
    public function dehydrate()
    {
        $this->dispatchBrowserEvent('render_select2');
    }
    public function render()
    {
        return view('livewire.job-order.edit');
    }
    public function update()
    {
        $data = $this->validate([
            'customer_id' => ['required'],
            'order_no' => ['nullable', 'string',  'max:255' ],

            'order_date' => ['required'],
            'order_type' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'quantity' => ['required', 'integer'],
            'unit_price' => ['required', 'numeric'],
            'active' => ['nullable'],
        ]);
        $data['total'] = $this->quantity*$this->unit_price;
        $data['slug'] = Str::slug($this->order_no);
        $this->jobOrder->update($data);

        // MaterialTransaction::where('job_order_id', $this->jobOrder->id)->update(['date', $this->jobOrder->order_date]);

        return redirect()->route('job-order.index')->with('status', 'A Job Order has been updated');
    }

    public function set_order_no()
    {
        $check = JobOrder::latest()->first();
        $max = 1;
        if ($check != null) {
            $max = JobOrder::latest('id')->first()->id + 1;
        }
        $this->order_no = "#6816".$max;
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

    public function reset_form()
    {
        $this->resetExcept('customers');
    }
}
