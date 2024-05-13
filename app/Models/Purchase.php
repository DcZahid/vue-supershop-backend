<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
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
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
