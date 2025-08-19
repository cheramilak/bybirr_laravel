<div>
    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{  'Kyc' }}</flux:heading>
        <flux:subheading>{{ 'Kyc Detail' }}</flux:subheading>
        <div class="flex mt-2">
            <div class="w-100 max-w">
            </div>
             <flux:spacer />
        </div>
        <div class="mt-5 w-full max-w">
            <div class="mt-3 relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    
                    <tbody>
                       <tr>
                            <td class="px-6 py-4">First Name</td>
                            <td class="px-6 py-4">{{ $kyc->fName }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Last Name</td>
                            <td class="px-6 py-4">{{ $kyc->lName }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Country</td>
                            <td class="px-6 py-4">{{ $kyc->country }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">ID Type</td>
                            <td class="px-6 py-4">{{ $kyc->idType }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">ID Number</td>
                            <td class="px-6 py-4">{{ $kyc->idNumber }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Phone</td>
                            <td class="px-6 py-4">{{ $kyc->phone }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">City</td>
                            <td class="px-6 py-4">{{ $kyc->city }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Address</td>
                            <td class="px-6 py-4">{{ $kyc->address }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Zip Code</td>
                            <td class="px-6 py-4">{{ $kyc->zipCode }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Line 1</td>
                            <td class="px-6 py-4">{{ $kyc->line1 }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">House Number</td>
                            <td class="px-6 py-4">{{ $kyc->houseNumber }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Photo</td>
                            <td class="px-6 py-4">
                                <img height="80" width="80" src="{{ asset('storage/' . $kyc->photo) }}" alt="Photo" class="w-16 h-16 object-cover rounded">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">ID Front</td>
                            <td class="px-6 py-4">
                                <img height="80" width="80" src="{{ asset('storage/' . $kyc->idFront) }}" alt="ID Front" class="w-16 h-16 object-cover rounded">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">ID Back</td>
                            <td class="px-6 py-4">
                                <img height="80" width="80" src="{{ asset('storage/' . $kyc->idBack) }}" alt="ID Back" class="w-16 h-16 object-cover rounded">
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Email</td>
                            <td class="px-6 py-4">{{ $kyc->email }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Birth Date</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($kyc->bod)->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">Status</td>
                            <td class="px-6 py-4">
                                @if($kyc->status == 'Active')
                                    <flux:badge color="lime">Approve</flux:badge>
                                @endif
                                @if($kyc->status == 'Pending')
                                    <flux:badge color="zinc">Pending</flux:badge>
                                @endif
                                @if($kyc->status == 'Failed')
                                    <flux:badge color="red">Failed</flux:badge>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>