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

    public function create(): View
    {
        return view('web.customers.create');
    }

    public function store(CustomerRequest $request, CustomerService $service): RedirectResponse
    {
        $service->create($request->getDto());
        return back()->with('success', 'New customer was created');
    }

    public function edit($id): View
    {
        $customer = Customer::findOrFail($id);
        return view('web.customers.edit', ['customer' => $customer]);
    }

    public function update($id, CustomerRequest $request, CustomerService $service): RedirectResponse
    {
        $service->update($id, $request->getDto());
        return back()->with('success', 'Customer has been successfully updated');
    }

    public function destroy($id): RedirectResponse
    {
        $customer = Customer::findOrFail($id);
        try
        {
            $customer->delete();
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            if ($e->getCode() == 23000)
            {
                return back()->with('error', 'Resource cannot be deleted due to existence of related resources.');
            }
        }

        return redirect()->route('customers.index');
    }

    public function showApi(): JsonResponse
    {
        return new JsonResponse(
            data: Customer::all(),
        );
    }
}
