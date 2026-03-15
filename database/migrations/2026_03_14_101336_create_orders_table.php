<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
			$table->id();
            $table->string('g_number', 100)->nullable();
            $table->date('date')->nullable();
            $table->date('last_change_date')->nullable();
            $table->string('supplier_article', 100)->nullable();
            $table->string('tech_size', 50)->nullable();
            $table->string('barcode', 50)->nullable();
            $table->decimal('total_price', 10, 2)->nullable()->default(0);
            $table->integer('discount_percent')->nullable()->default(0);
            $table->boolean('is_supply')->nullable();
            $table->boolean('is_realization')->nullable();
            $table->decimal('promo_code_discount', 10, 2)->nullable()->default(0);
            $table->string('warehouse_name', 100)->nullable();
            $table->string('country_name', 100)->nullable();
            $table->string('oblast_okrug_name', 100)->nullable();
            $table->string('region_name', 100)->nullable();
            $table->bigInteger('income_id')->nullable();
            $table->string('sale_id', 100)->nullable();
            $table->bigInteger('odid')->nullable();
            $table->decimal('spp', 5, 2)->nullable()->default(0);
            $table->decimal('for_pay', 10, 2)->nullable()->default(0);
            $table->decimal('finished_price', 10, 2)->nullable()->default(0);
            $table->decimal('price_with_disc', 10, 2)->nullable()->default(0);
            $table->bigInteger('nm_id')->nullable();
            $table->string('subject', 100)->nullable();
            $table->string('category', 50)->nullable();
            $table->string('brand', 100)->nullable();
            $table->boolean('is_storno')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
