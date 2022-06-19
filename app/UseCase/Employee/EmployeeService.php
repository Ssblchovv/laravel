<?php
namespace App\UseCase\Employee;

use App\Models\Employee;
use App\Dto\EmployeeDto;
use Illuminate\Contracts\Events\Dispatcher;

class EmployeeService
{
    public function __construct(
        public Dispatcher $dispatcher
    ) { }

    public function create(EmployeeDto $employeeDto): Employee
    {
        $employee = new Employee();
        $employee->first_name = $employeeDto->first_name;
        $employee->last_name = $employeeDto->last_name;
        $employee->patronymic = $employeeDto->patronymic;
        $employee->image = $employeeDto->image;
        $employee->saveOrFail();

        return $employee;
    }

    public function update(int $id, EmployeeDto $employeeDto): Employee
    {
        $employee = Employee::findOrFail($id);

        $employee->updateOrFail([
            'first_name' => $employeeDto->first_name,
            'last_name' => $employeeDto->last_name,
            'patronymic' => $employeeDto->patronymic,
            'image' => $employeeDto->image ?: $employee->image,
        ]);

        return $employee;
    }
}
