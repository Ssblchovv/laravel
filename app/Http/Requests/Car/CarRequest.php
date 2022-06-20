<?php

namespace App\Http\Requests\Car;

use App\Dto\CarDto;
use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'brand_id' => 'required|exists:brands,id',
            'model' => 'required|max:255',
        ];
    }

    public function getDto(): CarDto
    {
        return new CarDto(
            brand_id: $this->input('brand_id'),
            model: $this->input('model'),
        );
    }

}
