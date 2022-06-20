@extends('web.layout.wide')

@section('content')
    <h1 class="text-2xl">New customer's car</h1>

    <form method="POST" action="{{ route('ccs.store') }}" class="mt-10 space-y-5" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
            <div class="mt-1">
                <select id="customer_id" name="customer_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <option value="-1" selected>Select customer here</option>
                    @foreach  ($customersCollection as $customerItem)
                    <option value="{{$customerItem->id}}">{{$customerItem->last_name}} {{$customerItem->first_name}} {{$customerItem->patronymic}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label for="car_id" class="block text-sm font-medium text-gray-700">Car</label>
            <div class="mt-1">
                <select id="car_id" name="car_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                    <option value="-1" selected>Select customer here</option>
                    @foreach  ($carsCollection as $carItem)
                    <option value="{{$carItem->id}}">{{$carItem->brand->name}} {{$carItem->model}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
            <div class="mt-1">
                <input type="number" name="year" id="year" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <div>
            <label for="number" class="block text-sm font-medium text-gray-700">Number</label>
            <div class="mt-1">
                <input type="text" name="number" id="number" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <div>
          <label for="image" class="form-label inline-block mb-2 text-gray-700">Image</label>
          <div class="mt-1">
            <input class="form-control block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="image" name="image" type="file">
            </div>
        </div>
        <x-button>
            Create
        </x-button>
    </form>
@endsection
