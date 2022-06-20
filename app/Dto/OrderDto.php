<?php
namespace App\Dto;

use App\Enums\Status;

class OrderDto
{
    public function __construct(
        public readonly int $service_id,
        public readonly int $customer_car_id,
        public readonly int $employee_id,
        public readonly Status $status,
        public readonly \Illuminate\Support\Carbon $start_date,
        public readonly \Illuminate\Support\Carbon $end_date,
    ) { }
}
