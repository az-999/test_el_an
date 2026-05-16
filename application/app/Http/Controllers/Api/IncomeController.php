<?php

namespace App\Http\Controllers\Api;

use App\Filters\IncomeFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IncomeController extends Controller
{
    public function list(IncomeRequest $request): LengthAwarePaginator
    {
        return IncomeFilter::searchByRequest($request)
            ->paginate($request->limit ?? 500);
    }
}
