<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('g_number')->index();
            $table->string('supplier_article');
            $table->string('tech_size');
            $table->string('warehouse_name');
            $table->string('oblast');
            $table->string('odid');
            $table->string('subject');
            $table->string('category');
            $table->string('brand');
            $table->bigInteger('barcode');
            $table->string('income_id');
            $table->string('nm_id');
            $table->string('total_price', 20);
            $table->integer('discount_percent');
            $table->dateTime('date')->index();
            $table->date('last_change_date');
            $table->boolean('is_cancel')->default(false);
            $table->dateTime('cancel_dt')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
