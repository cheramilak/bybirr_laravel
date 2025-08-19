<div>
    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{  'User' }}</flux:heading>
        <flux:subheading>{{ 'Managem Users' }}</flux:subheading>
        <div class="flex mt-2">
            <div class="w-100 max-w">
                <flux:input  wire:model.live='search' placeholder="Serach" />
            </div>
             <flux:spacer />
            
        </div>
        <div class="mt-5 w-full max-w">
            <div class="mt-3 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                First Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Last Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Opration</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->first_name }}
                                </th>
                                <th  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->last_name }}
                                </th>
                                <th  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->email }}
                                </th>
                                <td class="px-6 py-4">
                                    <flux:badge color="{{ $item->status == 'Active' ? 'lime' : 'red' }}">{{ $item->status}}</flux:badge>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <flux:button wire:click='edit({{ $item->id }})' variant="primary">Edit</flux:button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>