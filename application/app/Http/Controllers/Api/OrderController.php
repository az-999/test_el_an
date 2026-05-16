<?php

namespace App\Http\Controllers\Api;

use App\Filters\OrderFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{
    public function list(OrderRequest $request): LengthAwarePaginator
    {
        return OrderFilter::searchByRequest($request)
            ->paginate($request->limit ?? 500);
    }
}
