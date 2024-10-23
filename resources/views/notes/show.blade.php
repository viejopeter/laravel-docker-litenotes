<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ !$note->trashed() ? 'Notes': 'Trash' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-alert-success>{{session('success')}}</x-alert-success>

            <span class="px-2 py-1 border border-indigo-400 bg-indigo-100 rounded font-semibold text-sm">
                {{$note->notebook->name}}
            </span>
            @if(!$note->trashed())
                <div class="flex gap-6">
                    <p><strong class="opacity-70">Created:</strong> {{$note->created_at->Diffforhumans()}}</p>
                    <p><strong class="opacity-70">Last changed:</strong>{{$note->updated_at->Diffforhumans()}}</p>
                    <x-link-button href="{{route('notes.edit',$note)}}" class="ml-auto">Edit Note</x-link-button>
                    <form action="{{route('notes.destroy',$note)}}" method="post">
                        @method('delete')
                        @csrf
                        <x-primary-button class="bg-red-500 hover:bg-red-600 focus:bg-red-600"
                                          onclick="return confirm('Are you sure you want to move to trash')">Move to
                            trash
                        </x-primary-button>
                    </form>
                </div>
            @else
                <div class="flex gap-6">
                    <p><strong class="opacity-70">Deleted:</strong> {{$note->deleted_at->Diffforhumans()}}</p>
                    <form action="{{route('trashed.update',$note)}}" method="post">
                        @method('put')
                        @csrf
                        <x-primary-button>Restore</x-primary-button>
                    </form>
                    <form action="{{route('trashed.destroy',$note)}}" method="post">
                        @method('delete')
                        @csrf
                        <x-primary-button class="bg-red-500 hover:bg-red-600 focus:bg-red-600"
                                          onclick="return confirm('Are you sure do you want to delete this note forever? This action can not be undone')">
                            Delete forever
                        </x-primary-button>
                    </form>
                </div>
            @endif
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl text-indigo-600">{{$note->title}}</h2>
                <p class="mt-4 whitespace-pre-wrap">{!! nl2br($note->text) !!}</p>
            </div>
        </div>
    </div>
</x-app-layout>
