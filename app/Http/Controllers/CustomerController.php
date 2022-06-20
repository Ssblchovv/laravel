<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\Customer\CustomerRequest;
use App\UseCase\Customer\CustomerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        $first_name = $request->query('first_name');
        $last_name = $request->query('last_name');
        $patronymic = $request->query('patronymic');
        $email = $request->query('email');
        $sex = $request->query('sex');
        $is_send_notify = $request->query('is_send_notify');

        $query = Customer::orderBy('id', 'desc');
        if ($first_name != null)
        {
            $query = $query->where('first_name', $first_name);
        }
        if ($last_name != null)
        {
            $query = $query->where('last_name', $last_name);
        }
        if ($patronymic != null)
        {
            $query = $query->where('patronymic', $patronymic);
        }
        if ($email != null)
        {
            $query = $query->where('email', $email);
        }
        if ($sex !== null and $sex !== '-1')
        {
            $query = $query->where('sex', $sex);
        }
        if ($is_send_notify !== null and $is_send_notify !== '-1')
        {
            $query = $query->where('is_send_notify', $is_send_notify);
        }
        $customersCollection = $query->paginate(5);
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
