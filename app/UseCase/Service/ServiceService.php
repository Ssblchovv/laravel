<?php
namespace App\UseCase\Service;

use App\Models\Service;
use App\Dto\ServiceDto;
use Illuminate\Contracts\Events\Dispatcher;

class ServiceService
{
    public function __construct(
        public Dispatcher $dispatcher
    ) { }

    public function create(ServiceDto $serviceDto): Service
    {
        $service = new Service();
        $service->id_service_category = $serviceDto->id_service_category;
        $service->name = $serviceDto->name;
        $service->duration = $serviceDto->duration;
        $service->price = $serviceDto->price;
        $service->saveOrFail();

        return $service;
    }

    public function update(int $id, ServiceDto $serviceDto): Service
    {
        $service = Service::findOrFail($id);

        $service->updateOrFail([
            'id_service_category' => $serviceDto->id_service_category,
            'name' => $serviceDto->name,
            'duration' => $serviceDto->duration,
            'price' => $serviceDto->price,
        ]);

        return $service;
    }
}
