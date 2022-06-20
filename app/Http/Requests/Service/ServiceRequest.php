<?php

namespace App\Http\Requests\Service;

use App\Dto\ServiceDto;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id_service_category' => 'required|exists:service_categories,id',
            'name' => 'required|max:255',
            'duration' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
        ];
    }

    public function getDto(): ServiceDto
    {
        return new ServiceDto(
            id_service_category: $this->input('id_service_category'),
            name: $this->input('name'),
            duration: $this->input('duration'),
            price: $this->input('price'),
        );
    }

}
