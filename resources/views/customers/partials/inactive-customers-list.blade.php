<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Expired Access Customers') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('List of all customers with expired access') }}
        </p>
    </header>

    <x-bladewind.table divider="thin">
        <x-slot name="header">
            <th>Name</th>
            <th>Department</th>
            <th>Email</th>
        </x-slot>
        <tr>
            <td>Alfred Rowe</td>
            <td>Outsourcing</td>
            <td>alfred@therowe.com</td>
        </tr>
        <tr>
            <td>Michael K. Ocansey</td>
            <td>Tech</td>
            <td>kabutey@gmail.com</td>
        </tr>
    </x-bladewind.table>
</section>
