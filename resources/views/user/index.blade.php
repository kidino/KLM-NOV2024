<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
<!--
                table.table.table-zebra<tab>

                thead>tr>th*4<tab>

                tbody>tr>td*4<tab>
-->

                {{ $users->links() }}

                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $users as $user )
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" 
                                class="btn btn-primary">EDIT</a>
                            </td>
                        </tr>
                    @endforeach 
                    </tbody>
                </table>
                                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




