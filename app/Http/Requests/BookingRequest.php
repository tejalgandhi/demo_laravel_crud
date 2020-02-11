<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email',
            'type'=>'required',
            'date'=>'required|date|date_format:Y-m-d|after:now',
            'time'=>'required|date_format:H:i:s',
            'slot'=>'sometimes|required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required',
            'email.required' => 'email is required',
            'email.email' => 'Please enter email in proper format',
            'date.required' => 'date is required',
            'date.after' => 'Please choose a future date',
            'date.date_format' => 'date is not in proper format',
            'time.required' => 'time is required',
            'time.date_format' => 'time is not in proper format',
//            'time.date_format' => 'Please choose a proper time',
            ];
    }
}
