<?php

namespace App\Observers;

use App\Models\JobOrder;
use Carbon\Carbon;
use App\Models\JobOrderActual;
use App\Models\MaterialTransaction;

class JobOrderActualObserver
{
    /**
     * Handle the JobOrderActual "created" event.
     *
     * @param  \App\Models\JobOrderActual  $jobOrderActual
     * @return void
     */
    public function created(JobOrderActual $jobOrderActual)
    {
        $jobOrder = JobOrder::findOrFail($jobOrderActual->job_order_id);
        MaterialTransaction::create([
            'job_order_id' => $jobOrderActual->job_order_id,
            'job_order_actual_id' => $jobOrderActual->id,

            'material_id' => $jobOrderActual->material_id,
            'material_type_id' => $jobOrderActual->material_type_id,
            'material_name' => $jobOrderActual->material_name,
            'type' => $jobOrderActual->type,
            'batch_no' => $jobOrderActual->batch_no,
            'unit_price' => $jobOrderActual->unit_price,

            'title' => "Job Order",
            'description' => "Job Order Actual has been Created",
            'date' => $jobOrderActual->material_date,
            'order_quantity' => $jobOrderActual->quantity,

        ]);
    }

    /**
     * Handle the JobOrderActual "updated" event.
     *
     * @param  \App\Models\JobOrderActual  $jobOrderActual
     * @return void
     */
    public function updated(JobOrderActual $jobOrderActual)
    {
        //
    }

    /**
     * Handle the JobOrderActual "deleted" event.
     *
     * @param  \App\Models\JobOrderActual  $jobOrderActual
     * @return void
     */
    public function deleted(JobOrderActual $jobOrderActual)
    {
        //
    }

    /**
     * Handle the JobOrderActual "restored" event.
     *
     * @param  \App\Models\JobOrderActual  $jobOrderActual
     * @return void
     */
    public function restored(JobOrderActual $jobOrderActual)
    {
        //
    }

    /**
     * Handle the JobOrderActual "force deleted" event.
     *
     * @param  \App\Models\JobOrderActual  $jobOrderActual
     * @return void
     */
    public function forceDeleted(JobOrderActual $jobOrderActual)
    {
        //
    }
}
