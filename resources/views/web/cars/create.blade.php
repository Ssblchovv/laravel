@extends('web.layout.wide')

@section('content')
    <h1 class="text-2xl">Create car</h1>

    <form method="POST" action="{{ route('cars.store') }}" class="mt-10 space-y-5">
        @csrf
        <div>
            <label for="brand_id" class="block text-sm font-medium text-gray-700">Brand</label>
            <div class="mt-1">
                <div class="mb-3 xl:w-96">
                    <select id="brand_id" name="brand_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option value="-1" selected>Select brand here</option>
                        @foreach  ($brandsCollection as $brandItem)
                        <option value="{{$brandItem->id}}">{{$brandItem->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div>
            <label for="model" class="block text-sm font-medium text-gray-700">Mode</label>
            <div class="mt-1">
              <input type="text" name="model" id="model" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <x-button>
            Create
        </x-button>
    </form>
@endsection
