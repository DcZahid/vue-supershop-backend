<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function sub_category() {
        return $this->belongsTo(Sub_category::class);
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    public function purchase() {
        return $this->hasMany(Purchase::class);
        // ekta purchase a onk gula product thakte pare abar ekta product er onk gula purchase hotee pare
    }
}
