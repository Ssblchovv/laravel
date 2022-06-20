<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\Employee\EmployeeRequest;
use App\UseCase\Employee\EmployeeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request): View
    {
        $first_name = $request->query('first_name');
        $last_name = $request->query('last_name');
        $patronymic = $request->query('patronymic');

        $query = Employee::orderBy('id', 'desc');
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
        $employeesCollection = $query->paginate(5);
        return view('web.employees.index', ['employeesCollection' => $employeesCollection]);
    }

    public function create(): View
    {
        return view('web.employees.create');
    }

    public function store(EmployeeRequest $request, EmployeeService $service): RedirectResponse
    {
        $service->create($request->getDto());
        return back()->with('success', 'New employee was created');
    }

    public function edit($id): View
    {
        $employee = Employee::findOrFail($id);
        return view('web.employees.edit', ['employee' => $employee]);
    }

    public function update($id, EmployeeRequest $request, EmployeeService $service): RedirectResponse
    {
        $service->update($id, $request->getDto());
        return back()->with('success', 'Employee has been successfully updated');
    }

    public function destroy($id): RedirectResponse
    {
        $employee = Employee::findOrFail($id);
        try
        {
            $employee->delete();
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            if ($e->getCode() == 23000)
            {
                return back()->with('error', 'Resource cannot be deleted due to existence of related resources.');
            }
        }

        return redirect()->route('employees.index');
    }

    public function showApi(): JsonResponse
    {
        return new JsonResponse(
            data: Employee::all(),
        );
    }
}
