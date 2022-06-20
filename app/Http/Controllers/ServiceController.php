<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Http\Requests\Service\ServiceRequest;
use App\UseCase\Service\ServiceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    public function index(): View
    {
        $servicesCollection = Service::with('serviceCategory')->orderBy('id', 'desc')->paginate(5);
        return view('web.services.index', ['servicesCollection' => $servicesCollection]);
    }

    public function create(): View
    {
        $scsCollection = ServiceCategory::orderBy('id', 'desc')->get();
        return view('web.services.create', ['scsCollection' => $scsCollection]);
    }

    public function store(ServiceRequest $request, ServiceService $service): RedirectResponse
    {
        $service->create($request->getDto());
        return back()->with('success', 'New service was created');
    }

    public function edit($id): View
    {
        $service = Service::findOrFail($id);
        $scsCollection = ServiceCategory::orderBy('id', 'desc')->get();
        return view('web.services.edit', ['service' => $service, 'scsCollection' => $scsCollection]);
    }

    public function update($id, ServiceRequest $request, ServiceService $service): RedirectResponse
    {
        $service->update($id, $request->getDto());
        return back()->with('success', 'Service has been successfully updated');
    }

    public function destroy($id): RedirectResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index');
    }

    public function showApi(): JsonResponse
    {
        return new JsonResponse(
            data: Service::all(),
        );
    }
}
