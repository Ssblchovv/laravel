@extends('web.layout.wide')

@section('content')
    <h1 class="text-2xl">New service category</h1>

    <form method="POST" action="{{ route('sc.store') }}" class="mt-10 space-y-5">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <div class="mt-1">
              <input type="text" name="name" id="name" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('name') }}">
            </div>
        </div>
        <button type="submit" class="w-full rounded-md px-4 py-3 font-semibold text-sm bg-sky-500 hover:bg-sky-600 text-white shadow-sm transition-colors">Create</button>

    </form>
@endsection
