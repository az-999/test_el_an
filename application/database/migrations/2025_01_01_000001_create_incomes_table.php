<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('income_id')->index();
            $table->string('number')->nullable();
            $table->date('date')->index();
            $table->date('last_change_date')->nullable();
            $table->string('supplier_article');
            $table->string('tech_size')->nullable();
            $table->bigInteger('barcode')->nullable();
            $table->integer('quantity');
            $table->string('total_price');
            $table->date('date_close')->nullable();
            $table->string('warehouse_name');
            $table->bigInteger('nm_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
