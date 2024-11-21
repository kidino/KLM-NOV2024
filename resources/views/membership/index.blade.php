<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Membership') }}
        </h2>
    </x-slot>

    <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <p><strong>Membership Details</strong></p>

                <p><strong>Plan:</strong> {{ Auth::user()->plan->name }}</p>
                <p>{{ Auth::user()->plan->description }}</p>
                <p><strong>Expiry:</strong> {{ Auth::user()->expiry_date }}</p>
            </div>
        </div>
    </div>



        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

        <div role="tablist" class="tabs tabs-bordered">

            @foreach($plans as $term => $term_plans) 


            <input type="radio" name="my_tabs_1" role="tab" 
            class="tab " aria-label="{{ ucfirst($term) }}" 
                @if($term == 'monthly') checked @endif
            />
            <div role="tabpanel" class="tab-content">            

                <div class="py-5 grid grid-cols-1 md:grid-cols-3 gap-10">

                @foreach ($term_plans as $plan)

                        <div class="card bg-base-100 shadow-xl mb-3">
                            <div class="card-body">
                                <h2 class="card-title">{{ $plan->name }}</h2>
                                <p>{{$plan->description}}</p>
                                <div class="card-actions justify-end">
                                <a 
                                    href="{{ route('checkout.go', [$plan->code, 'securepay']) }}"
                                
                                class="btn btn-primary">{{$plan->currencyMembershipFee}} Buy Now</a>
                                </div>
                            </div>
                        </div>

                @endforeach

                </div>

            </div><!-- /tabpanel -->


            @endforeach
        </div><!-- /tab-rolelist -->

            </div>
            </div>

        </div>
    </div>
</x-app-layout>
