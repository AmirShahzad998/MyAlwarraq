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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('material_name');
            $table->string('slug');
            $table->string('initial_stock_date');
            $table->decimal('unit_price')->nullable();
            $table->boolean('enable_sheet_size')->default(0);
            $table->boolean('enable_job_order')->default(0);
            $table->boolean('enable_n_a_option')->default(0);
            $table->integer('initial_stock')->default(0);
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
        Schema::dropIfExists('materials');
    }
};
