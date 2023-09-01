<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function transactions()
    {
        return $this->hasMany(MaterialTransaction::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

}
