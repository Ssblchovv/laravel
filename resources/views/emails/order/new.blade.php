<div>
    Service info. <br>
    Service category: {{ $order->service->serviceCategory->name }} <br>
    Service name: {{ $order->service->name }} <br>
    Duration: {{ $order->service->duration }} min. <br>
    Price: {{ $order->service->price }} RUB
</div>
<hr>
<div>
    Car info. <br>
    Brand: {{ $order->customerCar->car->brand->name }} <br>
    Model: {{ $order->customerCar->car->model }} <br>
    Year: {{ $order->customerCar->year }} <br>
    Number: {{ $order->customerCar->number }}
</div>
<hr>
<div>
    Employee info. <br>
    Full name: {{ $order->employee->last_name }} {{ $order->employee->first_name }} {{ $order->employee->patronymic }}
</div>