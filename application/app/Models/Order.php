<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'g_number',
        'supplier_article',
        'tech_size',
        'warehouse_name',
        'oblast',
        'odid',
        'subject',
        'category',
        'brand',
        'barcode',
        'income_id',
        'nm_id',
        'total_price',
        'discount_percent',
        'date',
        'last_change_date',
        'is_cancel',
        'cancel_dt',
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d H:i:s',
        'last_change_date' => 'date:Y-m-d',
        'cancel_dt' => 'datetime:Y-m-d H:i:s',
        'is_cancel' => 'boolean',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
