<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\Order\OrderRequest;
use App\Models\Car;
use App\Models\CustomerCar;
use App\Models\Employee;
use App\Models\Service;
use App\UseCase\Order\OrderService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View
    {
        $ordersCollection = Order::with(['service', 'customerCar', 'employee'])->orderBy('id', 'desc')->paginate(5);
        return view('web.orders.index', ['ordersCollection' => $ordersCollection]);
    }

    public function create(): View
    {
        $customersCollection = CustomerCar::with(['customer', 'car'])->orderBy('id', 'desc')->get();
        $employeesCollection = Employee::orderBy('id', 'desc')->get();
        $servicesCollection = Service::with('serviceCategory')->orderBy('id', 'desc')->get();
        return view('web.orders.create', [
            'customersCollection' => $customersCollection, 
            'employeesCollection' => $employeesCollection, 
            'servicesCollection' => $servicesCollection
        ]);
    }

    public function store(OrderRequest $request, OrderService $service): RedirectResponse
    {
        $order = $service->create($request->getDto());
        $service->notifyOrder($order);

        return back()->with('success', 'New order was created');
    }

    public function edit($id): View
    {
        $order = Order::findOrFail($id);
        $customersCollection = CustomerCar::with(['customer', 'car'])->orderBy('id', 'desc')->get();
        $employeesCollection = Employee::orderBy('id', 'desc')->get();
        $servicesCollection = Service::with('serviceCategory')->orderBy('id', 'desc')->get();
        return view('web.orders.edit', [
            'order' => $order, 
            'customersCollection' => $customersCollection, 
            'employeesCollection' => $employeesCollection, 
            'servicesCollection' => $servicesCollection
        ]);
    }

    public function update($id, OrderRequest $request, OrderService $service): RedirectResponse
    {
        $service->update($id, $request->getDto());
        return back()->with('success', 'Order car been successfully updated');
    }

    public function destroy($id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index');
    }

    public function showApi(): JsonResponse
    {
        return new JsonResponse(
            data: Order::all(),
        );
    }
}
