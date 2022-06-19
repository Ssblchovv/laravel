<?php
namespace App\Dto;

class EmployeeDto
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string|null $patronymic=null,
        public readonly string|null $image=null,
    ) { }
}
