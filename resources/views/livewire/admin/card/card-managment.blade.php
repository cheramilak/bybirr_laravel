<div>
    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ 'Card' }}</flux:heading>
        <flux:subheading>{{ 'Managem card' }}</flux:subheading>
        <div class="flex mt-2">
            <div class="w-100 max-w">
                <flux:input wire:model.live='search' placeholder="Serach" />
            </div>
            <flux:spacer />
            <flux:button wire:click='openModal'>Add new</flux:button>
        </div>
        <div class="mt-5 w-full max-w">
            <div class="mt-3 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Holder
                            </th>
                            <th scope="col" class="px-6 py-3">
                               Card
                            </th>
                            <th scope="col" class="px-6 py-3">
                                E date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                CVV
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Balance
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Opration</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cards as $item)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->cardholder_name }}
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->getMaskedCardNumberAttribute() }}
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     {{ $item->expiration_date }}
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     {{ $item->getMaskedCvvAttribute() }}
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     {{ number_format($item->balance,2) }}
                                </th>
                                <td class="px-6 py-4">
                                    <flux:badge color="{{ $item->status == 'Active' ? 'lime' : 'red' }}">
                                        {{ $item->status  }}</flux:badge>
                                </td>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     {{ $item->created_at->format('M d, y') }}
                                </th>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('adminCardOrderDetail',$item->uuid) }}"
                                        class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                                       <flux:button  variant="primary">Detail</flux:button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
