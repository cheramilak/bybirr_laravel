<div>
    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ 'Card order' }}</flux:heading>
        <flux:subheading>{{ 'Managem card orders' }}</flux:subheading>
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
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3">
                               Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone
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
                        @foreach ($cardOrders as $item)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ number_format($item->transaction->total,2) }}
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->kyc->fName ?? '' }}  {{ $item->kyc->lName ?? '' }}
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     {{ $item->kyc->email ?? '' }}
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                     {{ $item->kyc->phone ?? '' }}
                                </th>
                                <td class="px-6 py-4">
                                    <flux:badge color="{{ $item->status == 'Approve' ? 'lime' : 'red' }}">
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
