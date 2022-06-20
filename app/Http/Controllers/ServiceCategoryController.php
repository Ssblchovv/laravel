<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Http\Requests\ServiceCategory\ServiceCategoryRequest;
use App\UseCase\ServiceCategory\ServiceCategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ServiceCategoryController extends Controller
{
    public function index(): View
    {
        $scsCollection = ServiceCategory::orderBy('id', 'desc')->paginate(5);
        return view('web.sc.index', ['scsCollection' => $scsCollection]);
    }

    public function create(): View
    {
        return view('web.sc.create');
    }

    public function store(ServiceCategoryRequest $request, ServiceCategoryService $service): RedirectResponse
    {
        $service->create($request->getDto());
        return back()->with('success', 'New service category was created');
    }

    public function edit($id): View
    {
        $sc = ServiceCategory::findOrFail($id);
        return view('web.sc.edit', ['sc' => $sc]);
    }

    public function update($id, ServiceCategoryRequest $request, ServiceCategoryService $service): RedirectResponse
    {
        $service->update($id, $request->getDto());
        return back()->with('success', 'Service category has been successfully updated');
    }

    public function destroy($id): RedirectResponse
    {
        $sc = ServiceCategory::findOrFail($id);
        $sc->delete();

        return redirect()->route('sc.index');
    }

    public function showApi(): JsonResponse
    {
        return new JsonResponse(
            data: ServiceCategory::all(),
        );
    }
}
