<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'date',
        'last_change_date',
        'supplier_article',
        'tech_size',
        'subject',
        'category',
        'brand',
        'warehouse_name',
        'barcode',
        'quantity',
        'quantity_full',
        'in_way_to_client',
        'in_way_from_client',
        'nm_id',
        'sc_code',
        'is_supply',
        'is_realization',
        'price',
        'discount',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'last_change_date' => 'date:Y-m-d',
        'is_supply' => 'boolean',
        'is_realization' => 'boolean',
    ];

    protected $hidden = [
        'id',
    ];
}
