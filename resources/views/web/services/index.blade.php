@extends('web.layout.wide')

@section('content')
<h2 class="text-2xl">Services</h2>
<a href="{{route('services.create')}}" class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
    New
</a>
<table class="mt-10 min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration (min.)</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price (RUB)</th>
        <th scope="col" class="relative px-6 py-3">
          <span class="sr-only">Edit</span>
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Remove</span>
          </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse  ($servicesCollection as $serviceItem)
         <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$serviceItem->serviceCategory->name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$serviceItem->name}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$serviceItem->duration}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$serviceItem->price}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="{{route('services.edit', ['service' => $serviceItem])}}" class="text-slate-600 hover:text-slate-900">Edit</a>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <form action="{{route('services.destroy', ['service' => $serviceItem])}}" method="POST">
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
            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">No services</td>
          </tr>
        @endforelse
    </tbody>
  </table>


    {{ $servicesCollection->links() }}
@endsection
