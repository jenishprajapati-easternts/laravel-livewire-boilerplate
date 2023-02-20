<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Add User') }}
    </h2>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-12">
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <br wire:submit.prevent="save">
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
                                    <input type="text" wire:model="user.address" id="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="mobile_no" class="block text-sm font-medium text-gray-700">Birthday*</label>
                                    <input type="date" wire:model="user.dob" id="mobile_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('user.dob') <span class="text-red-500">{{ $message }}</span>@enderror
                                </div>

                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="button" wire:click="createUser" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>