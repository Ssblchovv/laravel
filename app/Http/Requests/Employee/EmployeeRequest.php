<?php

namespace App\Http\Requests\Employee;

use App\Dto\EmployeeDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class EmployeeRequest extends FormRequest
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
            'image' => 'nullable|mimes:jpeg',
        ];
    }

    public function getDto(): EmployeeDto
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
        return new EmployeeDto(
            first_name: $this->input('first_name'),
            last_name: $this->input('last_name'),
            patronymic: $this->input('patronymic'),
            image: $filename
        );
    }

}
