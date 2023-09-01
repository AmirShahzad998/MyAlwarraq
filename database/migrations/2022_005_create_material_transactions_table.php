<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->nullable()->constrained('purchases')->onDelete('cascade');
            $table->foreignId('purchase_detail_id')->nullable()->constrained('purchase_details')->onDelete('cascade');

            $table->foreignId('job_order_id')->nullable()->constrained('job_orders')->onDelete('cascade');
            $table->foreignId('job_order_actual_id')->nullable()->constrained('job_order_actuals')->onDelete('cascade');

            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
            $table->foreignId('material_type_id')->nullable()->constrained('material_types')->onDelete('cascade');
            $table->string('material_name');
            $table->string('type')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('unit_price')->nullable();

            $table->string('title');
            $table->string('description');
            $table->string('date');
            $table->integer('purchase_quantity')->default(0);
            $table->integer('order_quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_transactions');
    }
};
