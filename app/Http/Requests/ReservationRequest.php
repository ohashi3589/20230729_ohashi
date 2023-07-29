<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|integer|min:1',
            'restaurant_id' => 'required|exists:restaurants,id', 
        ];
    }

    public function messages()
    {
        return [
            'restaurant_id.exists' => '指定された店舗が存在しません。', 
        ];
    }
}
