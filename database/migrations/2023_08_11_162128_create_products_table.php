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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('subcategory_id')->index()->nullable();
            $table->unsignedBigInteger('childcategory_id')->index()->nullable();
            $table->unsignedBigInteger('brand_id')->index()->nullable();
            $table->unsignedBigInteger('unit_id')->index()->nullable();
            $table->string('product_name');
            $table->string('bar_code');
            $table->string('description', 5000)->nullable();
            $table->decimal('price',10,2)->default(0);
            $table->decimal('purchase_price',10,2)->default(0);
            $table->integer('status')->default(1)->comment('0 -> inactive 1 -> active');
            $table->string('image')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('childcategory_id')->references('id')->on('childcategories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
