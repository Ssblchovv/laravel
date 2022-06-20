@extends('web.layout.wide')

@section('content')
<div class="flex gap-5">
    <h2 class="text-2xl">Customers cars</h2>
    <a href="{{route('ccs.create')}}" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
        New
    </a>
</div>
<form method="GET" class="flex gap-5 mt-2">
    <div>
        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
        <div class="mt-1">
            <input type="number" name="year" id="year" class="h-10 shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{app('request')->input('year')}}">
        </div>
    </div>
    <div>
        <label for="number" class="block text-sm font-medium text-gray-700">Number</label>
        <div class="mt-1">
            <input type="text" name="number" id="number" class="h-10 shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{app('request')->input('number')}}">
        </div>
    </div>
    <div>
        <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
        <div class="mt-1">
            <select id="customer_id" name="customer_id" class="h-10 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                <option value="-1" {{app('request')->input('customer_id') == '-1' ? "selected" : ""}}>Select customer</option>
                    @foreach  ($customersCollection as $customerItem)
                    <option value="{{$customerItem->id}}" {{app('request')->input('customer_id') == $customerItem->id ? "selected" : ""}}>
                      {{$customerItem->last_name}} {{$customerItem->first_name}} {{$customerItem->patronymic}}
                    </option>
                    @endforeach
            </select>
        </div>
    </div>
    <x-button>
        Search
    </x-button>
</form>
<table class="mt-10 min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
        <th scope="col" class="relative px-6 py-3">
          <span class="sr-only">Edit</span>
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Remove</span>
          </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse  ($ccsCollection as $ccItem)
         <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <div class="w-20">
                    <img src="{{\Storage::url($ccItem->image)}}" class="max-w-full h-auto" alt="">
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$ccItem->car->brand->name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$ccItem->car->model}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$ccItem->year}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$ccItem->number}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$ccItem->customer->last_name}} {{$ccItem->customer->first_name}} {{$ccItem->customer->patronymic}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="{{route('ccs.edit', ['cc' => $ccItem])}}" class="text-slate-600 hover:text-slate-900">Edit</a>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <form action="{{route('ccs.destroy', ['cc' => $ccItem])}}" method="POST">
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
            <td colspan="9" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">No customers cars</td>
          </tr>
        @endforelse
    </tbody>
  </table>


    {{ $ccsCollection->appends($_GET)->links() }}
@endsection
