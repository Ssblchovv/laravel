<?php
namespace App\UseCase\Car;

use App\Models\Car;
use App\Dto\CarDto;
use Illuminate\Contracts\Events\Dispatcher;

class CarService
{
    public function __construct(
        public Dispatcher $dispatcher
    ) { }

    public function create(CarDto $carDto): Car
    {
        $car = new Car();
        $car->brand_id = $carDto->brand_id;
        $car->model = $carDto->model;
        $car->saveOrFail();

        return $car;
    }

    public function update(int $id, CarDto $carDto): Car
    {
        $car = Car::findOrFail($id);

        $car->updateOrFail([
            'brand_id' => $carDto->brand_id,
            'model' => $carDto->model,
        ]);

        return $car;
    }
}
