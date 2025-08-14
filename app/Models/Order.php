<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'order_number',
        'customer_details',
        'order_date',
        'attachment',
        'ordering_office',
        'ordering_officer',
        'order_items',
        'allow_shipping',
        'shipping_address',
        'shipping_method',
        'shipping_cost',
        'status',
        'subtotal',
        'tax',
        'total',
        'payment_method',
        'payment_status',
    ];

    protected $casts = [
        'customer_details' => 'array',
        'order_items'      => 'array',
        'order_date'       => 'date',
        'shipping_cost'    => 'float',
        'subtotal'         => 'float',
        'tax'              => 'float',
        'total'            => 'float',
    ];

    protected $attributes = [
        'allow_shipping' => 'N',
        'shipping_cost'  => 0,
        'status'         => 'pending',
        'subtotal'       => 0,
        'tax'            => 0,
        'total'          => 0,
        'payment_status' => 'unpaid',
    ];
}