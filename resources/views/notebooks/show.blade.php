<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Notebook
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex gap-6">
                <p><strong class="opacity-70">Created:</strong> {{$notebook->created_at->Diffforhumans()}}</p>
            </div>
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl text-indigo-600">{{$notebook->name}}</h2>
            </div>
        </div>
    </div>
</x-app-layout>
<?php
