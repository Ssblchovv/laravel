@extends('web.layout.layout')

@section('content-left')
    <h1 class="text-2xl">Employee Edit</h1>

    <form method="POST" action="{{route('customers.update', ['customer' => $customer])}}" class="mt-10 space-y-5">
        @method('PUT')
        @csrf
        <div class="grid grid-cols-2 gap-5">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                <div class="mt-1">
                  <input type="text" name="first_name" id="first_name" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $customer->first_name }}">
                </div>
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                <div class="mt-1">
                  <input type="text" name="last_name" id="last_name" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $customer->last_name }}">
                </div>
            </div>
            <div>
                <label for="patronymic" class="block text-sm font-medium text-gray-700">Patronymic</label>
                <div class="mt-1">
                  <input type="text" name="patronymic" id="patronymic" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $customer->patronymic }}">
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                  <input type="text" name="email" id="email" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $customer->email }}">
                </div>
            </div>
            <div>
                <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                <div class="mt-1">
                  <input type="checkbox" name="sex" id="sex" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" {{ $customer->sex  ? 'checked' : '' }}>
                </div>
            </div>
            <div>
                <label for="is_send_notify" class="block text-sm font-medium text-gray-700">Send notifications</label>
                <div class="mt-1">
                  <input type="checkbox" name="is_send_notify" id="is_send_notify" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" {{ $customer->is_send_notification ? 'checked' : '' }}>
                </div>
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
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First name</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last name</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patronymic</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sex</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notifications</th>
        <th scope="col" class="relative px-6 py-3">
          <span class="sr-only">Edit</span>
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Remove</span>
          </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse  ($customersCollection as $customerItem)
         <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$customerItem->first_name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$customerItem->last_name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$customerItem->patronymic}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$customerItem->email}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$customerItem->sex ? "male" : "female"}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$customerItem->is_send_notify ? "yes" : "no"}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="{{route('customers.edit', ['customer' => $customerItem])}}" class="text-slate-600 hover:text-slate-900">Edit</a>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <form action="{{route('customers.destroy', ['customer' => $customerItem])}}" method="POST">
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
            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">No customers</td>
          </tr>
        @endforelse
    </tbody>
  </table>


    {{ $customersCollection->links() }}
@endsection
