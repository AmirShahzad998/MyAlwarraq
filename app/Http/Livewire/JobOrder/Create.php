<?php

namespace App\Http\Livewire\JobOrder;

use Livewire\Component;
use App\Models\Customer;
use App\Models\JobOrder;
use Illuminate\Support\Str;

class Create extends Component
{
    public $customers;

    public $customer_id;
    public $order_no;
    public $order_date;
    public $order_type;
    public $description;
    public $quantity;
    public $unit_price;
    public $total = 0;

    public function mount()
    {
        $this->set_order_no();
        $this->customers = Customer::all();
    }
    public function dehydrate()
    {
        $this->dispatchBrowserEvent('render_select2');
    }
    public function render()
    {
        return view('livewire.job-order.create');
    }


    public function store()
    {
        $data = $this->validate([
            'customer_id' => ['required'],
            'order_no' => ['nullable', 'string',  'max:255' ,'unique:job_orders'],
            'order_date' => ['required'],
            'order_type' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3', 'max:255'],
            'quantity' => ['required', 'integer'],
            'unit_price' => ['required', 'numeric'],
        ]);
        $data['total'] = $this->quantity*$this->unit_price;
        $data['slug'] = Str::slug($this->order_no);

        JobOrder::create($data);
        return redirect()->route('job-order.index')->with('status', 'A New Job Order has been created');
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
