<?php
namespace App\UseCase\CustomerCar;

use App\Models\CustomerCar;
use App\Dto\CustomerCarDto;
use Illuminate\Contracts\Events\Dispatcher;

class CustomerCarService
{
    public function __construct(
        public Dispatcher $dispatcher
    ) { }

    public function create(CustomerCarDto $ccDto): CustomerCar
    {
        $cc = new CustomerCar();
        $cc->car_id = $ccDto->car_id;
        $cc->customer_id = $ccDto->customer_id;
        $cc->year = $ccDto->year;
        $cc->number = $ccDto->number;
        $cc->image = $ccDto->image;
        $cc->saveOrFail();

        return $cc;
    }

    public function update(int $id, CustomerCarDto $ccDto): CustomerCar
    {
        $cc = CustomerCar::findOrFail($id);

        $cc->updateOrFail([
            'car_id' => $ccDto->car_id,
            'customer_id' => $ccDto->customer_id,
            'year' => $ccDto->year,
            'number' => $ccDto->number,
            'image' => $ccDto->image ?: $cc->image,
        ]);

        return $cc;
    }
}
