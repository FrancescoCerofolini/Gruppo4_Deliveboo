<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_address', 'customer_email', 'customer_phone', 'customer_name', 'code', 'status'];
    
}
