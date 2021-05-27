<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function plates()
    {
        return $this->belongsToMany(Plate::class, 'plate_items');
    }
}
