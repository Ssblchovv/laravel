@extends('web.layout.layout')

@section('content-left')
    <h1 class="text-2xl">Book Edit</h1>

    <form method="POST" action="{{route('books.update', ['book' => $book])}}" class="mt-10 space-y-5">
        @method('PUT')
        @csrf

        <div>
            <label for="authors" class="block text-sm font-medium text-gray-700">Authors</label>
            <select multiple  id="authors" name="authors[]" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-slate-500 focus:border-slate-500 sm:text-sm rounded-md">
                @foreach($authorsList as $authorList)
                    <option value="{{$authorList->id}}" @selected(in_array($authorList->id, $bookAuthors->pluck('id')->toArray()  ))>
                        {{$authorList->name->getFull()}}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
            <div class="mt-1">
              <input type="text" name="isbn" id="isbn" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $book->isbn }}">
            </div>
          </div>
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <div class="mt-1">
              <input type="text" name="title" id="title" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $book->title }}">
            </div>
        </div>
        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
            <div class="mt-1">
              <textarea rows="4" name="excerpt" id="excerpt" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ $book->excerpt }}</textarea>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-3">
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <div class="mt-1">
                  <input type="number" name="price" id="price" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $book->price->amount }}">
                </div>
            </div>
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <div class="mt-1">
                    <input type="number" name="year" id="year" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $book->year }}">
                </div>
            </div>
            <div>
                <label for="page" class="block text-sm font-medium text-gray-700">Page</label>
                <div class="mt-1">
                  <input type="number" name="page" id="page" class="shadow-sm focus:ring-slate-500 focus:border-slate-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ $book->page }}">
                </div>
            </div>
        </div>

        <button type="submit" class="w-full rounded-md px-4 py-3 font-semibold text-sm bg-green-500 hover:bg-green-600 text-white shadow-sm transition-colors">Update</button>

    </form>



@endsection


@section('content-right')
<h2 class="text-2xl">Book Lists</h2>
<table class="mt-10 min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISBN</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Page</th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
        <th scope="col" class="relative px-6 py-3">
          <span class="sr-only">Edit</span>
        </th>
        <th scope="col" class="relative px-6 py-3">
            <span class="sr-only">Remove</span>
          </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">

        @forelse  ($booksCollection as $bookItem)

         <tr @class([ 'bg-green-100' => request()->fullUrlIs(route('books.edit', ['book' => $bookItem])) ])>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$bookItem->isbn}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$bookItem->title}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$bookItem->price->format()}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$bookItem->page}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$bookItem->year}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="{{route('books.edit', ['book' => $bookItem])}}" class="text-slate-600 hover:text-slate-900">Edit</a>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <form action="{{route('books.destroy', ['book' => $bookItem])}}" method="POST">
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
            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">No books</td>
          </tr>
        @endforelse
    </tbody>
  </table>


    {{ $booksCollection->links() }}

    <div class="mt-10">
        <h2 class="text-xl">Book Authors</h2>
        <table class="mt-5 min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Show</span>
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse  ($bookAuthors as $authorItem)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$authorItem->name->getFull()}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$authorItem->email}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{route('authors.edit', ['author' => $authorItem])}}" class="text-slate-600 hover:text-slate-900">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">No authors</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
@endsection
