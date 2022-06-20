<?php

namespace App\Http\Requests\CustomerCar;

use App\Dto\CustomerCarDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class CustomerCarRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'car_id' => 'required|exists:cars,id',
            'customer_id' => 'required|exists:customers,id',
            'year' => 'required|integer|min:1900|max:2022',
            'number' => 'required|string|min:6|max:6',
            'image' => 'nullable|mimes:jpeg',
        ];
    }

    public function getDto(): CustomerCarDto
    {
        $filename = null;
        $image = $this->file('image');
        if ($image !== null) {
            $filename = 'public/' . time() . '_' . $image->getClientOriginalName();
            $ok = Storage::disk("local")->put(
                $filename,
                file_get_contents($image)
            );
            if (!$ok) $filename = null;
        }
        return new CustomerCarDto(
            car_id: $this->input('car_id'),
            customer_id: $this->input('customer_id'),
            year: $this->input('year'),
            number: $this->input('number'),
            image: $filename,
        );
    }

}
