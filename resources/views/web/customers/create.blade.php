@extends('web.layout.wide')

@push('css')
<style>
    .grid-cols-3 {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
</style>
@endpush

@section('content')
    <h1 class="text-2xl">New customer</h1>

    <form method="POST" action="{{ route('customers.store') }}" class="mt-10 space-y-5">
        @csrf
        <div class="grid grid-cols-3 gap-5">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                <div class="mt-1">
                  <input type="text" name="first_name" id="first_name" class="h-10 shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('first_name') }}">
                </div>
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                <div class="mt-1">
                  <input type="text" name="last_name" id="last_name" class="h-10 shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('last_name') }}">
                </div>
            </div>
            <div>
                <label for="patronymic" class="block text-sm font-medium text-gray-700">Patronymic</label>
                <div class="mt-1">
                  <input type="text" name="patronymic" id="patronymic" class="h-10 shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('patronymic') }}">
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                  <input type="text" name="email" id="email" class="h-10 shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('email') }}">
                </div>
            </div>
            <div>
                <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                <div class="mt-1">
                    <select id="sex" name="sex" class="h-10 form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                        <option value="-1" selected>Select your sex</option>
                        <option value="0">Female</option>
                        <option value="1">Male</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="is_send_notify" class="block text-sm font-medium text-gray-700">Send notifications</label>
                <div class="mt-1">
                  <input type="checkbox" name="is_send_notify" id="is_send_notify" class="h-10 shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" {{ old('is_send_notify') ? 'checked' : '' }}>
                </div>
            </div>
        </div>
        <x-button>
            Create
        </x-button>
    </form>
@endsection
