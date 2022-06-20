<?php
namespace App\Dto;

class CustomerDto
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly bool $sex,
        public readonly bool $is_send_notify,
        public readonly string|null $patronymic=null,
        public readonly string|null $email=null,
    ) { }
}
