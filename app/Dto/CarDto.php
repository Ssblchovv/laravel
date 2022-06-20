<?php
namespace App\Dto;

class CarDto
{
    public function __construct(
        public readonly int $brand_id,
        public readonly string $model,
    ) { }
}
