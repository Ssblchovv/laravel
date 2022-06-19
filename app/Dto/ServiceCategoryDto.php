<?php
namespace App\Dto;

class ServiceCategoryDto
{
    public function __construct(
        public readonly string $name
    ) { }
}
