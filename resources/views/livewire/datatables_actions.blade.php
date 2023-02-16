<div class="flex justify-items-center">

    <!-- <a class="cursor-pointer mr-4" href="#">
        <x-icon name="eye" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
        </x-icon>
    </a> -->



    <a class="cursor-pointer mr-4">
        <x-icon name="pencil-square" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
        </x-icon>
    </a>


    <div class="cursor-pointer" wire:click="$emitTo('confirm', 'displayConfirmation', 'Delete Record', 'Are you sure?', '{{ $form }}', 'deleteCategory', '{{ $row->id }}')">

        <x-icon name="trash" class="text-indigo hover:text-red-500 mr-3 flex-shrink-0 h-6 w-6">
        </x-icon>
    </div>

</div>