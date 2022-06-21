@extends('web.layout.wide')

@section('content')
<div class="flex gap-5">
    <h2 class="text-2xl">Orders</h2>
    <a href="{{route('orders.create')}}" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
        New
    </a>
</div>
<form method="GET" class="flex gap-5 mt-2">
    <div>
        <label for="customer_car_id" class="block text-sm font-medium text-gray-700">Customer's car</label>
        <div class="mt-1">
            <select id="customer_car_id" name="customer_car_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                <option value="-1" {{app('request')->input('customer_car_id') == '-1' ? 'selected' : ''}}>Select customer's car here</option>
                @foreach  ($customersCollection as $customerItem)
                <option value="{{$customerItem->id}}" {{app('request')->input('customer_car_id') == $customerItem->id ? 'selected' : ''}}>
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
                <option value="-1" {{app('request')->input('service_id') == '-1' ? 'selected' : ''}}>Select service here</option>
                @foreach  ($servicesCollection as $serviceItem)
                <option value="{{$serviceItem->id}}" {{app('request')->input('service_id') == $serviceItem->id ? 'selected' : ''}}>
                  {{$serviceItem->serviceCategory->name}} {{$serviceItem->name}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee</label>
        <div class="mt-1">
            <select id="employee_id" name="employee_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                <option value="-1" {{app('request')->input('employee_id') == '-1' ? 'selected' : ''}}>Select employee here</option>
                @foreach  ($employeesCollection as $employeeItem)
                <option value="{{$employeeItem->id}}" {{app('request')->input('employee_id') == $employeeItem->id ? 'selected' : ''}}>
                  {{$employeeItem->last_name}} {{$employeeItem->first_name}} {{$employeeItem->patronymic}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <div class="mt-1">
            <select id="status" name="status" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                <option value="-1" {{app('request')->input('status') == '-1' ? 'selected' : ''}}>Select status here</option>
                <option value="0" {{app('request')->input('status') == '0' ? 'selected' : ''}}>Created</option>
                <option value="1" {{app('request')->input('status') == '1' ? 'selected' : ''}}>Completed</option>
            </select>
        </div>
    </div>
    <div>
        <label for="start_date" class="block text-sm font-medium text-gray-700">Starting date</label>
        <div class="mt-1">
            <input type="date" name="start_date" id="start_date" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{app('request')->input('start_date')}}">
        </div>
    </div>
    <div>
        <label for="end_date" class="block text-sm font-medium text-gray-700">Ending date</label>
        <div class="mt-1">
            <input type="date" name="end_date" id="end_date" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{app('request')->input('end_date')}}">
        </div>
    </div>
    <div>
        <label for="show_trashed" class="block text-sm font-medium text-gray-700">Show trashed</label>
        <div class="mt-1">
          <input type="checkbox" name="show_trashed" id="show_trashed" class="h-10 shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" {{ app('request')->input('show_trashed') ? 'checked' : '' }}>
        </div>
    </div>
    <x-button>
        Search
    </x-button>
</form>
<table class="mt-10 min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Car</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End</th>
        <th scope="col" class="relative px-6 py-3">
          <span class="sr-only">Edit</span>
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Remove</span>
          </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse  ($ordersCollection as $orderItem)
         <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$orderItem->service->serviceCategory->name}} / {{$orderItem->service->name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$orderItem->service->duration}} min.</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$orderItem->service->price}} RUB</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$orderItem->customerCar->car->brand->name}} {{$orderItem->customerCar->car->model}} {{$orderItem->customerCar->year}} @ {{$orderItem->customerCar->number}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$orderItem->customerCar->customer->last_name}} {{$orderItem->customerCar->customer->first_name}} {{$orderItem->customerCar->customer->patronymic}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$orderItem->employee->last_name}} {{$orderItem->employee->first_name}} {{$orderItem->employee->patronymic}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$orderItem->status == 0? "Created" : "Completed"}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{date('d.m.Y', strtotime($orderItem->start_date))}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{date('d.m.Y', strtotime($orderItem->end_date))}}</td>
            @if ($orderItem->trashed())
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="{{route('orders.restore', ['order' => $orderItem])}}" class="text-slate-600 hover:text-slate-900">Restore</a>
            </td>
            @else
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="{{route('orders.edit', ['order' => $orderItem])}}" class="text-slate-600 hover:text-slate-900">Edit</a>
            </td>
            @endif
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <form action="{{route('orders.destroy', ['order' => $orderItem])}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-400"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </button>
                 </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="11" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">No customers cars</td>
          </tr>
        @endforelse
    </tbody>
  </table>


    {{ $ordersCollection->appends($_GET)->links() }}
@endsection
