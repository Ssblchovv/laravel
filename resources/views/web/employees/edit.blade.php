@extends('web.layout.layout')

@section('content-left')
    <h1 class="text-2xl">Employee Edit</h1>

    <form method="POST" action="{{route('employees.update', ['employee' => $employee])}}" class="mt-10 space-y-5" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="grid grid-cols-2 gap-5">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                <div class="mt-1">
                  <input type="text" name="first_name" id="first_name" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $employee->first_name }}">
                </div>
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                <div class="mt-1">
                  <input type="text" name="last_name" id="last_name" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $employee->last_name }}">
                </div>
            </div>
            <div>
                <label for="patronymic" class="block text-sm font-medium text-gray-700">Patronymic</label>
                <div class="mt-1">
                  <input type="text" name="patronymic" id="patronymic" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $employee->patronymic }}">
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="mb-3 w-96">
              <label for="image" class="form-label inline-block mb-2 text-gray-700">Image</label>
              <input class="form-control block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="image" name="image" type="file">
            </div>
        </div>
        <x-button update >
            Update
        </x-button>
{{--        <button type="submit" class="w-full rounded-md px-4 py-3 font-semibold text-sm bg-green-500 hover:bg-green-600 text-white shadow-sm transition-colors">Update</button>--}}

    </form>
@endsection


@section('content-right')
<h2 class="text-2xl">Employees List</h2>
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


    {{ $employeesCollection->links() }}
@endsection
