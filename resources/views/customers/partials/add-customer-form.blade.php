<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add Customer') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add a new customer here to grant temporary access to videos to them.') }}
        </p>
    </header>
    <form method="post" action="{{ route('customers.create') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name"
                          placeholder="Name of the customer"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="hours" :value="__('Validity Duration (Hours)')"/>
            <x-text-input id="hours" name="hours" type="number" class="mt-1 block w-full" autocomplete="hours"
                          placeholder="Number of access hours" value="24" min="1" step="1"/>
            <x-input-error :messages="$errors->get('hours')" class="mt-2"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Add') }}</x-primary-button>

            @if (session('status') === 'customer-added')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-gray-400"
                >{{ __('New Customer Added.') }}</p>
            @endif
        </div>
    </form>
</section>
