<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\JobOrder;
use App\Models\Material;
use App\Models\Purchase;
use App\Models\MaterialType;
use App\Models\PurchaseDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialTransaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

 
    /**
     * Get the material that owns the MaterialTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
    public function material_type()
    {
        return $this->belongsTo(MaterialType::class, 'material_type_id');
    }
    public function job_order()
    {
        return $this->belongsTo(JobOrder::class, 'job_order_id');
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    public function purchase_detail()
    {
        return $this->belongsTo(PurchaseDetail::class, 'purchase_detail_id');
    }
}
