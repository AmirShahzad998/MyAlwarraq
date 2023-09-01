<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getUserImageAttribute()
    {
        return asset('storage/'. $this->attributes['customer_image']);
    }
}
