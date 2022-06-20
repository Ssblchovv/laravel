<?php
namespace App\UseCase\Customer;

use App\Models\Customer;
use App\Dto\CustomerDto;
use Illuminate\Contracts\Events\Dispatcher;

class CustomerService
{
    public function __construct(
        public Dispatcher $dispatcher
    ) { }

    public function create(CustomerDto $employeeDto): Customer
    {
        $employee = new Customer();
        $employee->first_name = $employeeDto->first_name;
        $employee->last_name = $employeeDto->last_name;
        $employee->patronymic = $employeeDto->patronymic;
        $employee->email = $employeeDto->email;
        $employee->sex = $employeeDto->sex;
        $employee->is_send_notify = $employeeDto->is_send_notify;
        $employee->saveOrFail();

        return $employee;
    }

    public function update(int $id, CustomerDto $employeeDto): Customer
    {
        $employee = Customer::findOrFail($id);

        $employee->updateOrFail([
            'first_name' => $employeeDto->first_name,
            'last_name' => $employeeDto->last_name,
            'patronymic' => $employeeDto->patronymic,
            'email' => $employeeDto->email,
            'sex' => $employeeDto->sex,
            'is_send_notify' => $employeeDto->is_send_notify,
        ]);

        return $employee;
    }
}
