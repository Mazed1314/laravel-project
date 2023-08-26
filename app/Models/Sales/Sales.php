<?php

namespace App\Models\Sales;

use App\Models\Products\Product;
use App\Models\Customers\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use HasFactory,SoftDeletes;
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
