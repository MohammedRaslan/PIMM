<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\StatusType;
use App\Enums\UserType;
use BenSampo\Enum\Rules\Enum;

class AuthRequest extends FormRequest
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
            'name' => [
                'required',
                'min:10',
                'max:255',
            ],
            'phone' => [
                'required',
                'min:11',
                'max:11'
            ],
            'govern' => [
                'required',
            ],
            'type' => [
                'required',
                'numeric',
                new EnumValue(UserType::class, false)
            ],
            'status' => [
                'required',
                'numeric',
                new EnumValue(StatusType::class, false)
            ],
            'password' => [
                'required',
                'max:255',
            ]
        ];
    }
}
