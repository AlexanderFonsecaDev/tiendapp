<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'size_id'       => 'required',
            'mark_id'       => 'required',
            'name'          => 'required',
            'quantity'      => 'required',
            'date_shipment' => 'required',
            'observation'   => 'required',
        ];
    }
}
