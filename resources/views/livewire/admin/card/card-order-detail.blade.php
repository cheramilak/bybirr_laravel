<div>
    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ 'card Order' }}</flux:heading>
        <flux:subheading>{{ 'Card Order Detail' }}</flux:subheading>
        <div class="flex mt-2">
            <div class="w-100 max-w">
            </div>
            <flux:spacer />
        </div>


        <div
            class="max-w p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <flux:icon.identification class="size-12" />
            <a href="#">
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Kyc Detail</h5>
            </a>
            <br>
            <div class="grid grid-flow-dense grid-cols-12 gap-4">
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">ID:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->kyc->id ?? '' }}</span>
                </div>

                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">First name:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->kyc->fName ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Last name:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->kyc->lName ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">ID Type:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->kyc->idType ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">ID Number:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->kyc->idNumber ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Phone:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->kyc->phone ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">City:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->kyc->city ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Address:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->kyc->address ?? '' }}</span>
                </div>

                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Zip code:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->kyc->zipCode ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Line1:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->kyc->line1 ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">House Number:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->kyc->houseNumber ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Status:</span>
                    <flux:badge color="{{ $cardOrder->kyc->status == 'Active' ? 'lime' : 'red' }}">
                                        {{ $cardOrder->kyc->status  }}</flux:badge>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Photo:</span>
                    <flux:avatar size="xl" src="{{ asset('storage/' . $cardOrder->kyc->photo ?? '') }}" />
                </div>

                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Id front:</span>
                    <flux:avatar size="xl" src="{{ asset('storage/' . $cardOrder->kyc->idFront ?? '') }}" />
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Id Back:</span>
                    <flux:avatar size="xl" src="{{ asset('storage/' . $cardOrder->kyc->idBack ?? '') }}" />
                </div>
            </div>
        </div>

        <br>

        {{-- Transaction --}}
        <div
            class="max-w p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <flux:icon.document-currency-dollar class="size-12" />
            <a href="#">
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Transaction detail</h5>
            </a>
            <br>
            <div class="grid grid-flow-dense grid-cols-12 gap-4">
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">ID:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->transaction->id ?? '' }}</span>
                </div>

                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Amount:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ number_format($cardOrder->transaction->amount ?? 0,2) }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Rate:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ number_format($cardOrder->transaction->rate ?? 0,2) }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Total:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ number_format($cardOrder->transaction->total ?? 0,2) }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Bank Id:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->transaction->bank->id ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Bank:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->transaction->bank->name ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Image:</span>
                    <flux:avatar size="xl" src="{{ asset('storage/' . $cardOrder->transaction->image ?? '') }}" />
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Transaction Id:</span>
                    <span
                        class="block text-sm mt-1 text-slate-600 dark:text-slate-200">{{ $cardOrder->transaction->transactionId ?? '' }}</span>
                </div>
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Status:</span>
                    <flux:badge color="{{ $cardOrder->transaction->status == 'Approve' ? 'lime' : 'red' }}">
                                        {{ $cardOrder->transaction->status  }}</flux:badge>
                </div>

                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                    <span class="block text-xs text-slate-400">Order status:</span>
                    <flux:badge color="{{ $cardOrder->status == 'Approve' ? 'lime' : 'red' }}">
                                        {{ $cardOrder->status  }}</flux:badge>
                </div>

                @if ($cardOrder->status != 'Approve')
                    <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                        <flux:button wire:click='create' variant="primary">Create Card
                        </flux:button>
                    </div>
                @endif
                <div class="col-span-6 sm:col-span-6 md:col-span-4 lg:col-span-4">
                        <flux:button wire:click='create' variant="primary">Create Card
                        </flux:button>
                </div>
            </div>
        </div>
    </div>
</div>
