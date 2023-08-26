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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index()->foreign()->references('id')->on('products')->onDlelet('cascade');
            $table->decimal('price',10,2)->default(0);
            $table->decimal('quantity',10,2);
            $table->decimal('discount',10,2);
            $table->decimal('vat',10,2);
            $table->float('total_amount',10,2);
            $table->unsignedBigInteger('supplier_id')->index()->foreign()->references('id')->on('suppliers')->onDlelet('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
