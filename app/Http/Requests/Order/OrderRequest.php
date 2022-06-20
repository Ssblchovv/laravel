<?php

namespace App\Http\Requests\Order;

use App\Enums\Status;
use App\Dto\OrderDto;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'service_id' => 'required|exists:services,id',
            'customer_car_id' => 'required|exists:customer_cars,id',
            'employee_id' => 'required|exists:employees,id',
            'status' => 'required|integer|min:0|max:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ];
    }

    public function getDto(): OrderDto
    {
        return new OrderDto(
            service_id: $this->input('service_id'),
            customer_car_id: $this->input('customer_car_id'),
            employee_id: $this->input('employee_id'),
            status: Status::from(intval($this->input('status'))),
            start_date: \Illuminate\Support\Carbon::parse($this->input('start_date')),
            end_date: \Illuminate\Support\Carbon::parse($this->input('end_date')),
        );
    }
}
