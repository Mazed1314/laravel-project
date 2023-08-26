<?php

namespace App\Models\Purchases;

use App\Models\Suppliers\Supplier;
use App\Models\Stock;
use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Purchase extends Model
{
    use HasFactory,SoftDeletes;
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
