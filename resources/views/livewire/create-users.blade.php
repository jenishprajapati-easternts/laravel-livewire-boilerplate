<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Add User') }}
    </h2>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-2 md:gap-12">
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <div class="overflow-hidden shadow sm:rounded-md">

                        <div class="bg-white px-4 py-5 sm:p-6">

                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium text-gray-700">First name *</label>
                                    <input type="text" wire:model="user.first_name" id="first-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('user.first_name') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Last name*</label>
                                    <input type="text" wire:model="user.last_name" id="last-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('user.last_name') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email-address" class="block text-sm font-medium text-gray-700">Email*</label>
                                    <input type="text" wire:model="user.email" id="email-address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('user.email') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="mobile_no" class="block text-sm font-medium text-gray-700">Mobile No*</label>
                                    <input type="text" wire:model="user.mobile_no" id="mobile_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('user.mobile_no') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>



                                <div class="col-span-6">
                                    <label for="street-address" class="block text-sm font-medium text-gray-700">Street address*</label>
                                    <!-- <input type="text" wire:model="user.address" id="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"> -->
                                    <textarea wire:model="user.address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="description" rows="5"></textarea>
                                    @error('user.address') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="country" class="block text-sm font-medium text-gray-700">Country*</label>
                                    <select id="country_id" wire:model="user.country_id" wire:change="getCountryStates" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        <option value="">-- Select Country --</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user.country_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="country" class="block text-sm font-medium text-gray-700">State*</label>
                                    <select id="state_id" wire:model="user.state_id" wire:change="getStateCities" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        <option value="">-- Select State --</option>
                                        @if(!empty($states))
                                        @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('user.state_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="country" class="block text-sm font-medium text-gray-700">City*</label>
                                    <select id="city_id" wire:model="user.city_id" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        <option value="">-- Select City --</option>
                                        @if(!empty($cities))
                                        @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('user.city_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="mobile_no" class="block text-sm font-medium text-gray-700">Birthday*</label>
                                    <input type="date" id="datepicker" max="<?php echo date("Y-m-d"); ?>" wire:model="user.dob" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('user.dob') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="mobile_no" class="block text-sm font-medium text-gray-700">Gender*</label>

                                    <div class="mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="form-radio" wire:model="user.gender" value="0">
                                            <span class="ml-2">Female</span>
                                        </label>
                                        <label class="inline-flex items-center ml-6">
                                            <input type="radio" class="form-radio" wire:model="user.gender" value="1">
                                            <span class="ml-2">Male</span>
                                        </label>
                                    </div>
                                    @error('user.gender') <span class="text-red-500">{{ $message }}</span>@enderror

                                </div>


                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="mobile_no" class="block text-sm font-medium text-gray-700">Hobbies*</label>

                                    <div class="mt-2">
                                        @foreach ($getHobbies as $key => $hobby)
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox" value="{{ $hobby->id }}" id="exampleFormControlInput3" wire:model="hobbies">
                                            <span class="ml-2">{{ $hobby->name }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                    @error('hobbies') <span class="text-red-500">{{ $message }}</span>@enderror
                                    @error('hobbies.*') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-span-6 sm:col-span-6">
                                    <!--  @if (!empty($galleries))
                                    Image Preview:
                                    <div class="flex space-x-4 items-start ...">
                                        @foreach ($galleries as $galleries)
                                        <div class="py-2">
                                            <img src="{{ $galleries->temporaryUrl() }}">
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif -->
                                    <div class="mt-2">
                                        <label for="galleries" class="block text-sm font-medium text-gray-700">Image Upload*</label>
                                        <input type="file" max="5" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" wire:model="galleries" multiple>
                                        <!-- <div wire:loading wire:target="galleries">Uploading...</div> -->

                                    </div>

                                    @error('galleries') <span class="text-red-500">{{ $message }}</span>@enderror
                                    @error('galleries.*') <span class="text-red-500">{{ $message }}</span>@enderror

                                </div>


                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Comment*</label>
                                    <input type="text" wire:model="comment.0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('comment.0') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                                <div class="px-4 py-6 text-right sm:px-6">
                                    <x-jet-button wire:click.prevent="add({{$i}})">
                                        {{ __('Add') }}
                                    </x-jet-button>
                                </div>


                                @foreach($inputs as $key => $value)

                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700">Comment*</label>
                                    <input type="text" wire:model="comment.{{ $value }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('comment.'.$value) <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                                <div class="px-4 py-6 text-right sm:px-6">
                                    <x-jet-danger-button wire:click.prevent="remove({{$key}})">
                                        {{ __('Remove') }}
                                    </x-jet-danger-button>
                                </div>

                                @endforeach

                            </div>
                        </div>

                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <x-jet-button wire:click="createUser">
                                {{ __('Save') }}
                            </x-jet-button>

                            <a href="{{ route('users')}}" class="inline-block rounded border-2 border-neutral-800 px-6 pt-2 pb-[6px] text-xs font-medium uppercase leading-normal text-neutral-800 transition duration-150 ease-in-out hover:border-neutral-800 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-neutral-800 focus:border-neutral-800 focus:text-neutral-800 focus:outline-none focus:ring-0 active:border-neutral-900 active:text-neutral-900 dark:border-neutral-900 dark:text-neutral-900 dark:hover:border-neutral-900 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10 dark:hover:text-neutral-900 dark:focus:border-neutral-900 dark:focus:text-neutral-900 dark:active:border-neutral-900 dark:active:text-neutral-900" data-te-ripple-init>
                                Cancel
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>