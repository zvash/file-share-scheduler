<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Active Customers') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('List of all active customers') }}
        </p>
    </header>

    <x-bladewind.table divider="thin">
        <x-slot name="header">
            <th>Name</th>
            <th>Hours</th>
            <th>Link</th>
            <th>Visited</th>
        </x-slot>
        @foreach($activeCustomers as $customer)
            <tr>
                <td>{{ $customer['name'] }}</td>
                <td>{{ $customer['hours'] }}</td>
                <td>
                    @if($customer['full_url'])
                        <a class="underline" href="{{ $customer['full_url'] }}">Temporary URL</a>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $customer['is_visited'] ? "✅" : "❌" }}</td>
            </tr>
        @endforeach
    </x-bladewind.table>
</section>
