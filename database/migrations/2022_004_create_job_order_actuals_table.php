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
        Schema::create('job_order_actuals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_order_id')->constrained('job_orders')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
            $table->foreignId('material_type_id')->nullable()->constrained('material_types')->onDelete('cascade');
            $table->string('material_name');
            $table->string('type')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('material_date')->nullable();
            $table->string('sheet_no')->nullable();
            $table->integer('sheet_quantity')->nullable();
            $table->integer('quantity');
            // $table->decimal('unit_price',10 , 9);
            // $table->decimal('total',10 , 9)->nullable();
            $table->string('unit_price');
            $table->string('total')->nullable();
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
        Schema::dropIfExists('job_order_actuals');
    }
};
