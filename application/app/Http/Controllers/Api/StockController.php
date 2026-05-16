<?php

namespace App\Http\Controllers\Api;

use App\Filters\StockFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StockController extends Controller
{
    public function list(StockRequest $request): LengthAwarePaginator
    {
        return StockFilter::searchByRequest($request)
            ->paginate($request->limit ?? 500);
    }
}
