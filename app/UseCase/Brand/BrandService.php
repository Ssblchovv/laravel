<?php
namespace App\UseCase\Brand;

use App\Models\Brand;
use App\Dto\BrandDto;
use Illuminate\Contracts\Events\Dispatcher;

class BrandService
{
    public function __construct(
        public Dispatcher $dispatcher
    ) { }

    public function create(BrandDto $brandDto): Brand
    {
        $brand = new Brand();
        $brand->name = $brandDto->name;
        $brand->saveOrFail();

        return $brand;
    }

    public function update(int $id, BrandDto $brandDto): Brand
    {
        $brand = Brand::findOrFail($id);

        $brand->updateOrFail([
            'name' => $brandDto->name,
        ]);

        return $brand;
    }
}
