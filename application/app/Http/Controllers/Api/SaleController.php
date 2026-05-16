<?php

namespace App\Http\Controllers\Api;

use App\Filters\SaleFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SaleController extends Controller
{
    public function list(SaleRequest $request): LengthAwarePaginator
    {
        return SaleFilter::searchByRequest($request)
            ->paginate($request->limit ?? 500);
    }
}
