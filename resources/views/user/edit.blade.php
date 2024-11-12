<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }} : {{ $user->name }} ({{ $user->id }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('user.update',$user->id ) }}" method="post">
                    @method('put')
                    @csrf 

                        <div class="mb-4">

                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" 
                            class="mt-1 block w-full" 
                            :value="old('name', $user->name)" 
                            required autocomplete="off" />
                        
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>


                        <div class="mb-4">    
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" 
                            class="mt-1 block w-full" 
                            :value="old('email', $user->email)" 
                            required autocomplete="username" />

                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>


                        <div class="mb-4">
                            <x-input-label for="user_type" :value="__('User Type')" />

                            <select name="user_type" id="user_type" class="select select-bordered w-full">
                                <option value="normal" 
                                    @selected( old('user_type', $user->user_type) == 'normal') >Normal</option>

                                <option value="admin"
                                    @selected( old('user_type', $user->user_type) == 'admin')>Admin</option>

                            </select>

                            <x-input-error class="mt-2" :messages="$errors->get('user_type')" />

                        </div>

                        <button class="btn btn-primary">SAVE</button>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
