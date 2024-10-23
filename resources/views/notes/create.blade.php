<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Note
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg sm:max-w-2xl">
                <form action="{{route('notes.store')}}" method="post">
                    @csrf
                    <x-text-input name="title" class="w-full" placeholder="Note title" value="{{old('title')}}"></x-text-input>
                    @error('title')
                    <div class="text-sm mt-1 text-red-500">{{$message}}</div>
                    @enderror
                    <x-textarea name="text" placeholder="Type your note" rows="8" value="{{old('text')}}"
                                class="w-full mt-6"></x-textarea>
                    @error('text')
                    <div class="text-sm mt-1 text-red-500">{{$message}}</div>
                    @enderror
                    <select name="notebook_id" class="w-full mt-6 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">--Select Notebook --</option>
                        @foreach($notebooks as $notebook)
                        <option value="{{$notebook->id}}">{{$notebook->name}}</option>
                        @endforeach
                    </select>
                    <x-primary-button class="mt-6">Save note</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
