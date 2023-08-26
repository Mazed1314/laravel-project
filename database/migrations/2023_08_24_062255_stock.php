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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index()->foreign()->references('id')->on('products')->onDlelet('cascade');
            $table->decimal('price',10,2)->default(0);
            $table->decimal('quantity',10,2);
            $table->unsignedBigInteger('purchase_id')->nullable()->index()->foreign()->references('id')->on('purchases')->onDlelet('cascade');
            $table->unsignedBigInteger('sale_id')->nullable()->index()->foreign()->references('id')->on('sales')->onDlelet('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
