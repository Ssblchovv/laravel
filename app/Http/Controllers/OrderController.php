<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\Order\OrderRequest;
use App\Models\CustomerCar;
use App\Models\Employee;
use App\Models\Service;
use App\UseCase\Order\OrderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $customer_car_id = $request->query('customer_car_id');
        $service_id = $request->query('service_id');
        $employee_id = $request->query('employee_id');
        $status = $request->query('status');
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');
        $show_trashed = $request->query('show_trashed');

        $query = Order::with(['service', 'customerCar', 'employee'])->orderBy('id', 'desc');
        if ($show_trashed !== null)
        {
            $query = $query->onlyTrashed();
        }
        if ($customer_car_id !== null and $customer_car_id !== '-1')
        {
            $query = $query->where('customer_car_id', $customer_car_id);
        }
        if ($service_id !== null and $service_id !== '-1')
        {
            $query = $query->where('service_id', $service_id);
        }
        if ($employee_id !== null and $employee_id !== '-1')
        {
            $query = $query->where('employee_id', $employee_id);
        }
        if ($status !== null and $status !== '-1')
        {
            $query = $query->where('status', $status);
        }
        if ($start_date != null)
        {
            $query = $query->where('start_date', $start_date);
        }
        if ($end_date != null)
        {
            $query = $query->where('end_date', $end_date);
        }
        $ordersCollection = $query->paginate(5);
        $customersCollection = CustomerCar::with(['customer', 'car'])->orderBy('id', 'desc')->get();
        $employeesCollection = Employee::orderBy('id', 'desc')->get();
        $servicesCollection = Service::with('serviceCategory')->orderBy('id', 'desc')->get();
        return view('web.orders.index', [
            'ordersCollection' => $ordersCollection,
            'customersCollection' => $customersCollection,
            'employeesCollection' => $employeesCollection,
            'servicesCollection' => $servicesCollection
        ]);
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

    public function complete($id): RedirectResponse
    {
        Order::findOrFail($id)->updateOrFail([
            'status' => \App\Enums\Status::COMPLETED->value,
        ]);
        return back()->with('success', 'Order marked as completed');
    }

    public function restore($id): RedirectResponse
    {
        Order::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Order was restored');
    }

    public function update($id, OrderRequest $request, OrderService $service): RedirectResponse
    {
        $service->update($id, $request->getDto());
        return back()->with('success', 'Order car been successfully updated');
    }

    public function destroy($id): RedirectResponse
    {
        try
        {
            $order = Order::findOrFail($id);
            $order->delete();
        }
        catch (ModelNotFoundException $e)
        {
            $order = Order::onlyTrashed()->findOrFail($id);
            $order->forceDelete();
            return back()->with('success', 'Order was completely deleted');
        }

        return back()->with('success', 'Order was trashed');
    }

    public function showApi(): JsonResponse
    {
        return new JsonResponse(
            data: Order::all(),
        );
    }
}
