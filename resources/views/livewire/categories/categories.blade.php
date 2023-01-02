<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Categories
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <button wire:click="create()" class="inline-flex items-center px-4 py-2 my-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                Create New Category
            </button>

            <!-- search -->
            <div class="py-4 space-y-4 w-1/4">
                <x-jet-input class="block mt-1 w-full" type="text" wire:model="search" placeholder="Search..." />
            </div>


            @if($isOpen)
            @include('livewire.categories.create')
            @endif
            
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 sort" wire:click="sortOrder('name')">Name {!! $sortLink !!}</th>
                        <th class="px-4 py-2 sort" wire:click="sortOrder('color')">Color {!! $sortLink !!}</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($categories->count())
                    @foreach($categories as $category)
                    <tr wire:loading.class="opacity-50">
                        <td class="border px-4 py-2">{{ $category->name }}</td>
                        <td class="border px-4 py-2">
                            <span style="background-color: {{ $category->color }};">&emsp;</span> {{ $category->color }}
                        </td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $category->id }})" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Edit
                            </button>
                            <a href="{{ url('admin/categories/'. $category->id .'/posts') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Show All Posts
                            </a>

                            <x-jet-danger-button wire:click="confirmCategoryDeletion( {{ $category->id}})" wire:loading.attr="disabled">
                                Delete
                            </x-jet-danger-button>

                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3" class="border px-4 py-2">
                            <div class="flex justify-center items-center">
                                <span class="font-medium py-8 text-cool-gray-500 text-xl">No record found...</span>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="py-4">
            {{ $categories->links() }}
        </div>

        <x-jet-confirmation-modal wire:model="confirmingCategoryDeletion">
            <x-slot name="title">
                {{ __('Delete Category') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete Category? ') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('confirmingCategoryDeletion', false)" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteCategory({{ $confirmingCategoryDeletion }})" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>


    </div>
</div>