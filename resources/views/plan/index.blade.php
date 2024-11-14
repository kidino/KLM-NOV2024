<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plans') }}
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

                <a href="{{ route('plan.create') }}" class="btn btn-primary">Create Plan</a>

                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>CODE</th>
                            <th>DESCRIPTION</th>
                            <th>TERM</th>
                            <th>FEE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse( $plans as $plan )
                        <tr>
                            <td>{{ $plan->id }}</td>
                            <td>{{ $plan->name }}</td>
                            <td>{{ $plan->code }}</td>
                            <td>{{ $plan->description }}</td>
                            <td>{{ $plan->term }}</td>
                            <td>{{ $plan->currency_membership_fee }}</td>
                            <td>
                                <a href="{{ route('plan.edit', $plan->id) }}" 
                                class="btn btn-secondary">EDIT</a>
                            </td>
                        </tr>
                    @empty 
                        <tr>
                            <td colspan="8" style="text-align: center">
                                <p>No plans defined. Create one now.</p>
                            </td>
                        </tr>
                    @endforelse 
                    </tbody>
                </table>
                                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




