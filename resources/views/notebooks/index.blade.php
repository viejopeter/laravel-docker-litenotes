<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Notebooks
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-link-button href="{{route('notebooks.create')}}">
                + New Notebook
            </x-link-button>
            @forelse($notebooks as $notebook)
                <div class="bg-white p-4 overflow-hidden shadow-sm sm:rounded-lg">
                    <a href="{{route('notebooks.show',$notebook)}}" class="hover:underline">
                        <h2 class="font-bold text-2xl text-indigo-600">{{$notebook->name}}</h2>
                    </a>
                </div>
            @empty
                <p>You have no notebooks yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
