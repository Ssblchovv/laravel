@extends('web.layout.wide')

@section('content')
    <h1 class="text-2xl">Edit service</h1>

    <form method="POST" action="{{route('services.update', ['service' => $service])}}" class="mt-10 space-y-5">
        @method('PUT')
        @csrf
        <div>
            <label for="id_service_category" class="block text-sm font-medium text-gray-700">Category</label>
            <div class="mt-1">
                <div class="mb-3 xl:w-96">
                    <select id="id_service_category" name="id_service_category" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option value="-1">Select service category here</option>
                        @foreach  ($scsCollection as $scItem)
                        <option value="{{$scItem->id}}" {{$service->serviceCategory == $scItem ? "selected" : ""}}>{{$scItem->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <div class="mt-1">
                <input type="text" name="name" id="name" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{$service->name}}">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-5">
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700">Duration (min.)</label>
                <div class="mt-1">
                    <input type="number" name="duration" id="duration" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{$service->duration}}">
                </div>
            </div>
            <div>
                <label for="number" class="block text-sm font-medium text-gray-700">Price (RUB)</label>
                <div class="mt-1">
                    <input type="text" name="price" id="price" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{$service->price}}">
                </div>
            </div>
        </div>
        <x-button>
            Create
        </x-button>
    </form>
@endsection
