<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function teamable()
    {
        return $this->morphOne(People::class, 'teamable');
    }
    public function sale() {
        return $this->hasMany(Sale::class);
    }
}
