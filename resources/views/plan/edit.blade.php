<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plan') }} : {{ $plan->name }} ({{ $plan->code }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('plan.update', $plan->id) }}" method="post">
                    @method('put')
                    @csrf 

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" 
                            class="mt-1 block w-full" 
                            :value="old('name', $plan->name)" 
                            required autocomplete="off" />

                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>


                        <div class="mb-4">
                            <x-input-label for="code" :value="__('Code')" />
                            <x-text-input id="code" name="code" type="text" 
                            class="mt-1 block w-full" 
                            :value="old('code', $plan->code)" 
                            required autocomplete="off" />
                        
                            <x-input-error class="mt-2" :messages="$errors->get('code')" />
                        </div>            
                        
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" 
                            class="textarea textarea-bordered w-full h-32" 
                            placeholder="Type your description here...">{{ old('description', $plan->description) }}</textarea>
                        
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>                           


                        <div class="mb-4">
                            <x-input-label for="term" :value="__('Term')" />

                            <select name="term" id="term" class="select select-bordered w-full">
                                <option value="monthly" 
                                    @selected( old('term', $plan->term) == 'monthly') >Monthly</option>

                                <option value="yearly"
                                    @selected( old('term', $plan->term) == 'yearly')>Yearly</option>

                                <option value="lifetime"
                                    @selected( old('term', $plan->term) == 'yearly')>Lifetime</option>                                    
                            </select>

                            <x-input-error class="mt-2" :messages="$errors->get('term')" />

                        </div>

                        <div class="mb-4">
                            <x-input-label for="membership_fee" :value="__('Fee')" />
                            <x-text-input id="membership_fee" name="membership_fee" type="text" 
                            class="mt-1 block w-full" 
                            :value="old('membership_fee', $plan->decimal_membership_fee)" 
                            required autocomplete="off" />
                        
                            <x-input-error class="mt-2" :messages="$errors->get('membership_fee')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="currency" :value="__('Currency')" />
                            <x-text-input id="currency" name="currency" type="text" 
                            class="mt-1 block w-full" 
                            :value="old('currency', $plan->currency)" 
                            required autocomplete="off" />
                        
                            <x-input-error class="mt-2" :messages="$errors->get('currency')" />
                        </div>                            



                        <button type="submit" class="btn btn-primary">SAVE</button>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
