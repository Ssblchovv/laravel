<?php
namespace App\UseCase\ServiceCategory;

use App\Models\ServiceCategory;
use App\Dto\ServiceCategoryDto;
use Illuminate\Contracts\Events\Dispatcher;

class ServiceCategoryService
{
    public function __construct(
        public Dispatcher $dispatcher
    ) { }

    public function create(ServiceCategoryDto $serviceCategoryDto): ServiceCategory
    {
        $serviceCategory = new ServiceCategory();
        $serviceCategory->name = $serviceCategoryDto->name;
        $serviceCategory->saveOrFail();

        return $serviceCategory;
    }

    public function update(int $id, ServiceCategoryDto $ServiceCategoryDto): ServiceCategory
    {
        $serviceCategory = ServiceCategory::findOrFail($id);

        $serviceCategory->updateOrFail([
            'name' => $ServiceCategoryDto->name,
        ]);

        return $serviceCategory;
    }
}
