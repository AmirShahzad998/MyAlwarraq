<?php

namespace App\Observers;

use App\Models\Material;
use Carbon\Carbon;
use App\Models\MaterialType;
use App\Models\MaterialTransaction;

class MaterialTypeObserver
{
    /**
     * Handle the MaterialType "created" event.
     *
     * @param  \App\Models\MaterialType  $materialType
     * @return void
     */
    public function created(MaterialType $materialType)
    {
        $material = Material::findOrFail($materialType->material_id);
        $material->update(['initial_stock' => 0]);
        MaterialTransaction::where('material_id', $material->id)->where('description', 'Initial Stock has been added for Material')
        ->update([
            'purchase_quantity' => 0
        ]);

        if ($materialType->initial_stock > 0) {
        MaterialTransaction::create([
            'material_id' => $material->id,
            'material_name' => $material->material_name,
            'material_type_id' => $materialType->id,
            'type' => $materialType->type,
            'unit_price' => $materialType->unit_price,
            'title' => "Initial Stock",
            'description' => "Initial Stock has been added for Material Type",
            'date' => Carbon::parse($material->initial_stock_date)->toDateString(),
            'purchase_quantity' => is_null($materialType->initial_stock) ? 0 : $materialType->initial_stock,

        ]);
    }

    }

    /**
     * Handle the MaterialType "updated" event.
     *
     * @param  \App\Models\MaterialType  $materialType
     * @return void
     */
    public function updated(MaterialType $materialType)
    {
        //
    }

    /**
     * Handle the MaterialType "deleted" event.
     *
     * @param  \App\Models\MaterialType  $materialType
     * @return void
     */
    public function deleted(MaterialType $materialType)
    {
        //
    }

    /**
     * Handle the MaterialType "restored" event.
     *
     * @param  \App\Models\MaterialType  $materialType
     * @return void
     */
    public function restored(MaterialType $materialType)
    {
        //
    }

    /**
     * Handle the MaterialType "force deleted" event.
     *
     * @param  \App\Models\MaterialType  $materialType
     * @return void
     */
    public function forceDeleted(MaterialType $materialType)
    {
        //
    }
}
