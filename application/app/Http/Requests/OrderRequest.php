<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ValidatesApiDates;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    use ValidatesApiDates;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dateFrom' => 'required|date_format:Y-m-d',
            'dateTo' => 'required|date_format:Y-m-d|after_or_equal:dateFrom',
            'limit' => 'nullable|numeric|min:1|max:500',
        ];
    }
}
