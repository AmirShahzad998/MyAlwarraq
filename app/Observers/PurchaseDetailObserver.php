<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\PurchaseDetail;
use App\Models\MaterialTransaction;
use App\Models\Purchase;

class PurchaseDetailObserver
{
    /**
     * Handle the PurchaseDetail "created" event.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return void
     */
    public function created(PurchaseDetail $purchaseDetail)
    {
        $purchase = Purchase::findOrFail($purchaseDetail->purchase_id);
        // if($purchaseDetail->quantity > 0){
        MaterialTransaction::create([
            'purchase_id' => $purchaseDetail->purchase_id,
            'purchase_detail_id' => $purchaseDetail->id,

            'material_id' => $purchaseDetail->material_id,
            'material_type_id' => $purchaseDetail->material_type_id,
            'material_name' => $purchaseDetail->material_name,
            'type' => $purchaseDetail->type,
            'batch_no' => $purchaseDetail->batch_no,
            'unit_price' => $purchaseDetail->unit_price,

            'title' => "Purchase",
            'description' => "Purchase Invoice has been Created",
            'date' => $purchase->purchase_date,
            'purchase_quantity' => $purchaseDetail->quantity,

        ]);
    // }
    }

    /**
     * Handle the PurchaseDetail "updated" event.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return void
     */
    public function updated(PurchaseDetail $purchaseDetail)
    {
        // dd($purchaseDetail);
        // $purchase = Purchase::findOrFail($purchaseDetail->purchase_id);
        // MaterialTransaction::where('purchase_id', $purchase->id)->update([
        //     'purchase_id' => $purchaseDetail->purchase_id,
        //     'purchase_detail_id' => $purchaseDetail->id,

        //     'material_id' => $purchaseDetail->material_id,
        //     'material_type_id' => $purchaseDetail->material_type_id,
        //     'material_name' => $purchaseDetail->material_name,
        //     'type' => $purchaseDetail->type,
        //     'batch_no' => $purchaseDetail->batch_no,
        //     'unit_price' => $purchaseDetail->unit_price,

        //     'title' => "Purchase",
        //     'description' => "Purchase Invoice has been Created",
        //     'date' => $purchase->purchase_date,
        //     'purchase_quantity' => $purchaseDetail->quantity,

        // ]);

    }

    /**
     * Handle the PurchaseDetail "deleted" event.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return void
     */
    public function deleted(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Handle the PurchaseDetail "restored" event.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return void
     */
    public function restored(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Handle the PurchaseDetail "force deleted" event.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return void
     */
    public function forceDeleted(PurchaseDetail $purchaseDetail)
    {
        //
    }
}
