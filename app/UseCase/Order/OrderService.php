<?php
namespace App\UseCase\Order;

use App\Mail\NewOrder;
use App\Models\Order;
use App\Dto\OrderDto;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;

class OrderService
{
    public function __construct(
        public Mailer $mailer,
        public Dispatcher $dispatcher
    ) { }

    public function create(OrderDto $orderDto): Order
    {
        $order = new Order();
        $order->service_id = $orderDto->service_id;
        $order->customer_car_id = $orderDto->customer_car_id;
        $order->employee_id = $orderDto->employee_id;
        $order->status = $orderDto->status;
        $order->start_date = $orderDto->start_date;
        $order->end_date = $orderDto->end_date;
        $order->saveOrFail();

        return $order;
    }


    public function notifyOrder($order)
    {
        if ($order->customerCar->customer->is_send_notify) 
        {
            $this->mailer->send(new NewOrder($order));
        }
    }

    public function update(int $id, OrderDto $orderDto): Order
    {
        $order = Order::findOrFail($id);

        $order->updateOrFail([
            'service_id' => $orderDto->service_id,
            'customer_car_id' => $orderDto->customer_car_id,
            'employee_id' => $orderDto->employee_id,
            'status' => $orderDto->status,
            'start_date' => $orderDto->start_date,
            'end_date' => $orderDto->end_date,
        ]);

        return $order;
    }
}
