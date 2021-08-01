<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['date',
      'user_id',
'customer_name',
 'customer_tel', 'customer_address',
        'order',
     'delivery',
     'comments',
        'order_comments',
     'dowoz',
        'status',
        'total'];
}
