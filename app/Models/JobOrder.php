<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobOrder extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

 

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Get all of the comments for the JobOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estimated_materials()
    {
        return $this->hasMany(JobOrderEstimate::class);
    }
    public function actual_materials()
    {
        return $this->hasMany(JobOrderActual::class);
    }


}
