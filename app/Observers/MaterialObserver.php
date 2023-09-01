<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\Material;
use App\Models\MaterialTransaction;

class MaterialObserver
{
    /**
     * Handle the Material "created" event.
     *
     * @param  \App\Models\Material  $material
     * @return void
     */
    public function created(Material $material)
    {

        if ($material->initial_stock > 0) {

            MaterialTransaction::create([

                'material_id' => $material->id,
                'material_name' => $material->material_name,
                'unit_price' => $material->unit_price,

                'title' => "Initial Stock",
                'description' => "Initial Stock has been added for Material",
                // 'date' => $material->initial_stock_date->toDateString(),
                'date' => Carbon::parse($material->initial_stock_date)->toDateString(),
                'purchase_quantity' => is_null($material->initial_stock) ? 0 : $material->initial_stock,

            ]);
        }



    }

    /**
     * Handle the Material "updated" event.
     *
     * @param  \App\Models\Material  $material
     * @return void
     */
    public function updated(Material $material)
    {

        MaterialTransaction::updateOrCreate(
            [
                'material_id' => $material->id,
                'material_name' => $material->material_name,
                'title' => 'Initial Stock',
                'description' => "Initial Stock has been added for Material",
            ],
            [
                'unit_price' => $material->unit_price,
                'date' => Carbon::parse($material->initial_stock_date)->toDateString(),
                'purchase_quantity' =>is_null($material->initial_stock) ? 0 : $material->initial_stock,
            ]);

    }

    /**
     * Handle the Material "deleted" event.
     *
     * @param  \App\Models\Material  $material
     * @return void
     */
    public function deleted(Material $material)
    {
        //
    }

    /**
     * Handle the Material "restored" event.
     *
     * @param  \App\Models\Material  $material
     * @return void
     */
    public function restored(Material $material)
    {
        //
    }

    /**
     * Handle the Material "force deleted" event.
     *
     * @param  \App\Models\Material  $material
     * @return void
     */
    public function forceDeleted(Material $material)
    {
        //
    }
}
