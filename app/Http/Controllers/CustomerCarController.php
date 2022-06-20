<?php

namespace App\Http\Controllers;

use App\Models\CustomerCar;
use App\Http\Requests\CustomerCar\CustomerCarRequest;
use App\Models\Car;
use App\Models\Customer;
use App\UseCase\CustomerCar\CustomerCarService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CustomerCarController extends Controller
{
    public function index(): View
    {
        $ccsCollection = CustomerCar::with(['car', 'customer'])->orderBy('id', 'desc')->paginate(5);
        return view('web.ccs.index', ['ccsCollection' => $ccsCollection]);
    }

    public function create(): View
    {
        $customersCollection = Customer::orderBy('id', 'desc')->get();
        $carsCollection = Car::with('brand')->orderBy('id', 'desc')->get();
        return view('web.ccs.create', ['customersCollection' => $customersCollection, 'carsCollection' => $carsCollection]);
    }

    public function store(CustomerCarRequest $request, CustomerCarService $service): RedirectResponse
    {
        $service->create($request->getDto());
        return back()->with('success', 'New customer\'s car was created');
    }

    public function edit($id): View
    {
        $cc = CustomerCar::findOrFail($id);
        $customersCollection = Customer::orderBy('id', 'desc')->get();
        $carsCollection = Car::with('brand')->orderBy('id', 'desc')->get();
        return view('web.ccs.edit', ['cc' => $cc, 'customersCollection' => $customersCollection, 'carsCollection' => $carsCollection]);
    }

    public function update($id, CustomerCarRequest $request, CustomerCarService $service): RedirectResponse
    {
        $service->update($id, $request->getDto());
        return back()->with('success', 'Customer\'s car has been successfully updated');
    }

    public function destroy($id): RedirectResponse
    {
        $cc = CustomerCar::findOrFail($id);
        try
        {
            $cc->delete();
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            if ($e->getCode() == 23000)
            {
                return back()->with('error', 'Resource cannot be deleted due to existence of related resources.');
            }
        }

        return redirect()->route('ccs.index');
    }

    public function showApi(): JsonResponse
    {
        return new JsonResponse(
            data: CustomerCar::all(),
        );
    }
}
