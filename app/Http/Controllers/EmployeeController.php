<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\Employee\EmployeeRequest;
use App\UseCase\Employee\EmployeeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $employeesCollection = Employee::orderBy('id', 'desc')->paginate(5);
        return view('web.employees.index', ['employeesCollection' => $employeesCollection]);
    }

    public function store(EmployeeRequest $request, EmployeeService $service): RedirectResponse
    {
        $service->create($request->getDto());
        return back()->with('success', 'New employee was created');
    }

    public function edit($id): View
    {
        $employee = Employee::findOrFail($id);
        $employeesCollection = Employee::orderBy('id', 'desc')->paginate(5);

        return view('web.employees.edit', ['employee' => $employee, 'employeesCollection' => $employeesCollection]);
    }

    public function update($id, EmployeeRequest $request, EmployeeService $service): RedirectResponse
    {
        $service->update($id, $request->getDto());
        return back()->with('success', 'Employee has been successfully updated');
    }

    public function destroy($id): RedirectResponse
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index');
    }

    public function showApi(): JsonResponse
    {
        return new JsonResponse(
            data: Employee::all(),
        );
    }
}
