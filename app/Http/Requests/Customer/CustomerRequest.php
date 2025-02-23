<?php

namespace App\Http\Requests\Customer;

use App\Dto\CustomerDto;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'patronymic' => 'max:255',
            'email' => 'nullable|email',
            'sex' => 'nullable|integer|min:0|max:1',
            'is_send_notify' => 'nullable',
        ];
    }

    public function getDto(): CustomerDto
    {
        return new CustomerDto(
            first_name: $this->input('first_name'),
            last_name: $this->input('last_name'),
            patronymic: $this->input('patronymic'),
            email: $this->input('email'),
            sex: $this->input('sex') === '1',
            is_send_notify: $this->request->has('is_send_notify'),
        );
    }

}
