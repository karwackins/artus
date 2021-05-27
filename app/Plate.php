<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Product;

class Plate extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'plate_items');
    }
}
