<?php
namespace App\Dto;

class CustomerCarDto
{
    public function __construct(
        public readonly int $car_id,
        public readonly int $customer_id,
        public readonly int $year,
        public readonly string $number,
        public readonly string|null $image,
    ) { }
}
