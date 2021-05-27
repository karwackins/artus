<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    use HasFactory;

    public function products() {
        return $this->hasMany('App\Product');
    }
}
