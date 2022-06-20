@extends('web.layout.wide')

@section('content')
    <h1 class="text-2xl">New order</h1>

    <form method="POST" action="{{ route('orders.store') }}" class="mt-10 space-y-5">
        @csrf
        <div>
            <label for="customer_car_id" class="block text-sm font-medium text-gray-700">Customer's car</label>
            <div class="mt-1">
                <select id="customer_car_id" name="customer_car_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <option value="-1" selected>Select customer's car here</option>
                    @foreach  ($customersCollection as $customerItem)
                    <option value="{{$customerItem->id}}">
                        {{$customerItem->car->brand->name}} {{$customerItem->car->model}} {{$customerItem->car->year}}
                         - 
                        {{$customerItem->customer->last_name}} {{$customerItem->customer->first_name}} {{$customerItem->customer->patronymic}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label for="service_id" class="block text-sm font-medium text-gray-700">Service</label>
            <div class="mt-1">
                <select id="service_id" name="service_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <option value="-1" selected>Select service here</option>
                    @foreach  ($servicesCollection as $serviceItem)
                    <option value="{{$serviceItem->id}}">{{$serviceItem->serviceCategory->name}} {{$serviceItem->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee</label>
            <div class="mt-1">
                <select id="employee_id" name="employee_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <option value="-1" selected>Select employee here</option>
                    @foreach  ($employeesCollection as $employeeItem)
                    <option value="{{$employeeItem->id}}">{{$employeeItem->last_name}} {{$employeeItem->first_name}} {{$employeeItem->patronymic}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <div class="mt-1">
                <select id="status" name="status" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <option value="-1" selected>Select status here</option>
                    <option value="0">Created</option>
                    <option value="1">Completed</option>
                </select>
            </div>
        </div>
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Starting date</label>
            <div class="mt-1">
                <input type="date" name="start_date" id="start_date" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700">Ending date</label>
            <div class="mt-1">
                <input type="date" name="end_date" id="end_date" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <x-button>
            Create
        </x-button>
    </form>
@endsection
