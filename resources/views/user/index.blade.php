<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

@if(session('success'))
<div role="alert" class="alert alert-success mb-5">
  <svg
    xmlns="http://www.w3.org/2000/svg"
    class="h-6 w-6 shrink-0 stroke-current"
    fill="none"
    viewBox="0 0 24 24">
    <path
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{ session('success') }}</span>
</div>
@endif

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
                            <th>USER TYPE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $users as $user )
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->user_type }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" 
                                class="btn btn-secondary">EDIT</a>
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




