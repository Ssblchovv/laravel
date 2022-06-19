<?php

namespace App\Http\Requests\Brand;

use App\Dto\BrandDto;
use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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

    public function getDto(): BrandDto
    {
        return new BrandDto(
            name: $this->input('name'),
        );
    }

}
