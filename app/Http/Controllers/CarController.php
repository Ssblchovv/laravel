<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use App\Http\Requests\Car\CarRequest;
use App\UseCase\Car\CarService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class CarController extends Controller
{
    public function index(): View
    {
        $carsCollection = Car::with('brand')->orderBy('id', 'desc')->paginate(5);
        return view('web.cars.index', ['carsCollection' => $carsCollection]);
    }

    public function create(): View
    {
        $brandsCollection = Brand::orderBy('id', 'desc')->get();
        return view('web.cars.create', ['brandsCollection' => $brandsCollection]);
    }

    public function store(CarRequest $request, CarService $service): RedirectResponse
    {
        $service->create($request->getDto());
        return back()->with('success', 'New car was created');
    }

    public function edit($id): View
    {
        $car = Car::findOrFail($id);
        $brandsCollection = Brand::orderBy('id', 'desc')->get();
        return view('web.cars.edit', ['car' => $car, 'brandsCollection' => $brandsCollection]);
    }

    public function update($id, CarRequest $request, CarService $service): RedirectResponse
    {
        $service->update($id, $request->getDto());
        return back()->with('success', 'Car has been successfully updated');
    }

    public function destroy($id): RedirectResponse
    {
        $car = Car::findOrFail($id);
        try
        {
            $car->delete();
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            if ($e->getCode() == 23000)
            {
                return back()->with('error', 'Resource cannot be deleted due to existence of related resources.');
            }
        }

        return redirect()->route('cars.index');
    }

    public function showApi(): JsonResponse
    {
        return new JsonResponse(
            data: Car::all(),
        );
    }
}
