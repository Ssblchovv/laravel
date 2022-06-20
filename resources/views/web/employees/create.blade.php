@extends('web.layout.wide')

@push('css')
<style>
    .grid-cols-3 {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
</style>
@endpush

@section('content')
    <h1 class="text-2xl">New employee</h1>

    <form method="POST" action="{{ route('employees.store') }}" class="mt-10 space-y-5" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-3 gap-5">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                <div class="mt-1">
                  <input type="text" name="first_name" id="first_name" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('first_name') }}">
                </div>
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                <div class="mt-1">
                  <input type="text" name="last_name" id="last_name" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('last_name') }}">
                </div>
            </div>
            <div>
                <label for="patronymic" class="block text-sm font-medium text-gray-700">Patronymic</label>
                <div class="mt-1">
                  <input type="text" name="patronymic" id="patronymic" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('patronymic') }}">
                </div>
            </div>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label inline-block mb-2 text-gray-700">Image</label>
          <input class="form-control block w-full px-2 py-1 text-sm font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="image" name="image" type="file">
        </div>
        <x-button>
            Create
        </x-button>
    </form>
@endsection
