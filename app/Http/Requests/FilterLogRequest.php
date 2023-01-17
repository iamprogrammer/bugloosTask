<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    : array
    {
        return [
            "startDate"    => ["nullable","date"],
            "endDate"      => ["nullable","date"],
            "serviceNames" => ["nullable","string"],
            "statusCode"   => ["nullable","numeric"]
        ];
    }
}
