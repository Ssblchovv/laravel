<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\Customer\CustomerRequest;
use App\UseCase\Customer\CustomerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customersCollection = Customer::orderBy('id', 'desc')->paginate(5);
        return view('web.customers.index', ['customersCollection' => $customersCollection]);
    }

    public function store(CustomerRequest $request, CustomerService $service): RedirectResponse
    {
        $service->create($request->getDto());
        return back()->with('success', 'New customer was created');
    }

    public function edit($id): View
    {
        $customer = Customer::findOrFail($id);
        $customersCollection = Customer::orderBy('id', 'desc')->paginate(5);

        return view('web.customers.edit', ['customer' => $customer, 'customersCollection' => $customersCollection]);
    }

    public function update($id, CustomerRequest $request, CustomerService $service): RedirectResponse
    {
        $service->update($id, $request->getDto());
        return back()->with('success', 'Customer has been successfully updated');
    }

    public function destroy($id): RedirectResponse
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index');
    }

    public function showApi(): JsonResponse
    {
        return new JsonResponse(
            data: Customer::all(),
        );
    }
}
