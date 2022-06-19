<?php

namespace App\Http\Requests\ServiceCategory;

use App\Dto\ServiceCategoryDto;
use Illuminate\Foundation\Http\FormRequest;

class ServiceCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
        ];
    }

    public function getDto(): ServiceCategoryDto
    {
        return new ServiceCategoryDto(
            name: $this->input('name'),
        );
    }

}
