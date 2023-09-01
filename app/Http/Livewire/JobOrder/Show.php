<?php

namespace App\Http\Livewire\JobOrder;

use App\Models\Customer;
use App\Models\Material;
use Livewire\Component;

class Show extends Component
{
    public $jobOrder;
    public $customers;
    public $materials;
    public $all_materials;

    public function mount($jobOrder)
    {
        $this->jobOrder = $jobOrder;
        $this->customers = Customer::all();
        $this->materials = Material::all();
        $this->all_materials = Material::all();
    }
    public function render()
    {
        return view('livewire.job-order.show');
    }
}
