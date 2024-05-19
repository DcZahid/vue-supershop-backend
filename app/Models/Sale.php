<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    // public function purchase()
    // {
    //     return $this->hasMany(Purchase::class);
    // }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sub_category()
    {
        return $this->belongsTo(Sub_category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    
}
