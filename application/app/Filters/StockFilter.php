<?php

namespace App\Filters;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

class StockFilter implements FilterInterface
{
    public static function searchByRequest(FormRequest $request): Builder
    {
        return Stock::query()->whereDate('date', $request->dateFrom);
    }
}
