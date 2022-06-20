<?php
namespace App\Dto;

class ServiceDto
{
    public function __construct(
        public readonly int $id_service_category,
        public readonly string $name,
        public readonly int $duration,
        public readonly int $price,
    ) { }
}
