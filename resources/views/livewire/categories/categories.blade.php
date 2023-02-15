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
            <!-- <div class="py-4 space-y-4 w-1/4">
                <x-jet-input class="block mt-1 w-full" type="text" wire:model="search" placeholder="Search..." />
            </div> -->


            @if($isOpen)
            @include('livewire.categories.create')
            @endif

            <livewire:category-table />

        </div>


        <!-- confirmation-modal -->
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