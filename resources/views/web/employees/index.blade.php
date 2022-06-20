@extends('web.layout.wide')

@section('content')
<div class="flex gap-5">
    <h2 class="text-2xl">Employees</h2>
    <a href="{{route('employees.create')}}" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
        New
    </a>
</div>
<form method="GET" class="flex gap-5 mt-2">
    <div>
        <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
        <div class="mt-1">
          <input type="text" name="first_name" id="first_name" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ app('request')->input('first_name') }}">
        </div>
    </div>
    <div>
        <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
        <div class="mt-1">
          <input type="text" name="last_name" id="last_name" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ app('request')->input('last_name') }}">
        </div>
    </div>
    <div>
        <label for="patronymic" class="block text-sm font-medium text-gray-700">Patronymic</label>
        <div class="mt-1">
          <input type="text" name="patronymic" id="patronymic" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ app('request')->input('patronymic') }}">
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
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First name</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last name</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patronymic</th>
        <th scope="col" class="relative px-6 py-3">
          <span class="sr-only">Edit</span>
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Remove</span>
          </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse  ($employeesCollection as $employeeItem)
         <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <div class="w-20">
                    <img src="{{\Storage::url($employeeItem->image)}}" class="max-w-full h-auto rounded-full" alt="">
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$employeeItem->first_name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$employeeItem->last_name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$employeeItem->patronymic}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="{{route('employees.edit', ['employee' => $employeeItem])}}" class="text-slate-600 hover:text-slate-900">Edit</a>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <form action="{{route('employees.destroy', ['employee' => $employeeItem])}}" method="POST">
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
            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">No employees</td>
          </tr>
        @endforelse
    </tbody>
  </table>


    {{ $employeesCollection->appends($_GET)->links() }}
@endsection
