<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @bodyParam shipment_left_time string required UTC date as a string, must be greater than LST starting point (1969-07-21 02:56:15). Example: 2021-08-26 12:30:35
 */
class ShipmentEstimationRequest extends FormRequest
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
            'shipment_left_time' => 'required|date',
        ];
    }
}
