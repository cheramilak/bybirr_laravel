<div>
    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ 'Banks' }}</flux:heading>
        <flux:subheading>{{ 'Managem bank' }}</flux:subheading>
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
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Code
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Account name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Account number
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
                        @foreach ($banks as $item)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <img height="100" width="100" class="h-15 w-15 rounded-lg"
                                        src="{{ asset('storage/' . $item->image) }}" alt="image description">
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->name }}
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->code }}
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->accountName }}
                                </th>
                                <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->number }}
                                </th>
                                <td class="px-6 py-4">
                                    <flux:badge color="{{ $item->status == 1 ? 'lime' : 'red' }}">
                                        {{ $item->status == 1 ? 'Active' : 'Block' }}</flux:badge>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <flux:button wire:click='edit({{ $item->id }})' variant="primary">Edit
                                    </flux:button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        

        <flux:modal name="modal-form" class="md:w-96">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Bank form</flux:heading>
                </div>

                <form wire:submit='submit'>
                    <flux:input label="Name" wire:model='name' />
                    <flux:input label="Code" wire:model='code' />
                    <flux:input label="bank image" type='file' wire:model='image' />
                    @if ($image)
                        <img class="h-30 max-w-lg rounded-lg" src="{{ $image->temporaryUrl() }}" alt="image description">
                    @endif
                    <flux:input label="Account name" wire:model='accountName' />
                    <flux:input label="Account number" wire:model='number' />
                    <flux:checkbox wire:model="status" label="Status" />

                   <div class="flex mt-2">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Save changes</flux:button>
                    </div>
                </form>
                

                
            </div>
        </flux:modal>
    </div>
</div>
