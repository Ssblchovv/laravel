<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\Brand\BrandRequest;
use App\UseCase\Brand\BrandService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class BrandController extends Controller
{
    public function index(): View
    {
        $brandsCollection = Brand::orderBy('id', 'desc')->paginate(5);
        return view('web.brands.index', ['brandsCollection' => $brandsCollection]);
    }

    public function create(): View
    {
        return view('web.brands.create');
    }

    public function store(BrandRequest $request, BrandService $service): RedirectResponse
    {
        $service->create($request->getDto());
        return back()->with('success', 'New brand was created');
    }

    public function edit($id): View
    {
        $brand = Brand::findOrFail($id);
        return view('web.brands.edit', ['brand' => $brand]);
    }

    public function update($id, BrandRequest $request, BrandService $service): RedirectResponse
    {
        $service->update($id, $request->getDto());
        return back()->with('success', 'Brand has been successfully updated');
    }

    public function destroy($id): RedirectResponse
    {
        $brand = Brand::findOrFail($id);
        try
        {
            $brand->delete();
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            if ($e->getCode() == 23000)
            {
                return back()->with('error', 'Resource cannot be deleted due to existence of related resources.');
            }
        }

        return redirect()->route('brands.index');
    }

    public function showApi(): JsonResponse
    {
        return new JsonResponse(
            data: Brand::all(),
        );
    }
}
