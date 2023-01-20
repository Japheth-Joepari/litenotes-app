<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('+ Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg border-gray-50">
                <form action=" {{ route('notes.update', $note) }}" method="post">
                    @method("put")
                    @csrf
                    <input
                        type="text"
                        name="title"
                        field="title"
                        placeholder="Title"
                        class="w-full rounded-md border-gray-300"
                        autocomplete="off"
                        value="{{@old('title', $note->title) }}"
                        ></input>
                        @error('title')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    
                    <textarea
                        name="text"
                        rows="10"
                        field="text"
                        placeholder="Start typing here..."
                        class="w-full mt-6 rounded-md border-gray-300"
                       >{{@old('text', $note->text)}}</textarea>
                       @error('text')
                            <div class="text-red-600 text-sm">{{ $message }}</div>
                        @enderror
                    
                    <button class="mt-6 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">+ Update Note</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>