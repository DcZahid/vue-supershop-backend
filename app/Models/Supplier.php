<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function teamable()
    {
        return $this->morphOne(People::class, 'teamable');
    }
    public function purchase()
    {
        return $this->hasMany(Purchase::class);
    }
}
