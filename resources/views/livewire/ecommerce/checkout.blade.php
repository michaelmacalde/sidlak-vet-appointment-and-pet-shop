<div>
    {{-- Buy Now Mode Indicator --}}
    {{-- @if ($isBuyNowMode)
        <div
            class="ml-3 p-3 bg-orange-50 border border-orange-200 rounded-lg mb-4 dark:bg-orange-900/20 dark:border-orange-800">
            <h3 class="text-sm font-semibold text-orange-800 dark:text-orange-200">Buy Now Mode</h3>
            <div class="mt-1 text-sm text-orange-700 dark:text-orange-300">
                <p>You're checking out a single item. Other cart items will not be included in this order.</p>
            </div>
        </div>
    @endif --}}

    {{-- Back to Shop Button --}}
    {{-- <div class="mb-4 ml-3 mt-4">
        <a wire:navigate href="{{ route('page.shop') }}"
            class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-amber-700 focus:bg-amber-700 active:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
            Back to Shop
        </a>
    </div> --}}

    <div class="p-4 md:p-8 mx-auto my-6 md:my-12 max-w-7xl -mt-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
            {{-- Product Summary --}}
            <div class="order-2 lg:order-1">
                <h2 class="mb-4 text-xl md:text-2xl font-bold text-gray-800 dark:text-neutral-200">
                    {{ __('Product Summary') }}</h2>
                <div
                    class="bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 overflow-hidden">
                    <div class="p-4 md:p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-800">
                                    <tr>
                                        <th scope="col"
                                            class="px-3 py-3 text-left text-xs md:text-sm font-medium text-gray-500 dark:text-neutral-400 uppercase">
                                            Product</th>
                                        <th scope="col"
                                            class="px-3 py-3 text-right text-xs md:text-sm font-medium text-gray-500 dark:text-neutral-400 uppercase">
                                            Price</th>
                                        <th scope="col"
                                            class="px-3 py-3 text-right text-xs md:text-sm font-medium text-gray-500 dark:text-neutral-400 uppercase">
                                            Qty</th>
                                        <th scope="col"
                                            class="px-3 py-3 text-right text-xs md:text-sm font-medium text-gray-500 dark:text-neutral-400 uppercase">
                                            Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @foreach ($checkoutItems as $item)
                                        <tr wire:key="item-{{ $item->id }}">
                                            <td class="px-3 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                <div class="flex items-center">
                                                    <div wire:ignore
                                                        class="w-12 h-12 md:w-16 md:h-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 dark:border-neutral-700">
                                                        @if (isset($item->variant))
                                                            <img src="{{ Storage::url($item->variant->url) }}"
                                                                alt="{{ $item->product->prod_name }}"
                                                                class="w-full h-full object-cover">
                                                        @else
                                                            @if ($item->product->primary_image && $item->product->primary_image->url)
                                                                <img src="{{ Storage::url($item->product->primary_image->url) }}"
                                                                    alt="{{ $item->product->prod_name }}"
                                                                    class="w-full h-full object-cover">
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="ml-3" wire:ignore>
                                                        <h3
                                                            class="text-sm md:text-base font-medium text-gray-900 dark:text-neutral-200 line-clamp-2">
                                                            {{ $item->product->prod_name }}
                                                            @if (isset($item->variant))
                                                                -   {{ ucwords(preg_replace('/[^a-zA-Z0-9\s]/', ' ', $item->variant->sizes)) }}
                                                            @endif
                                                            @if ($item->product->prod_unit === 'kg' || $item->product->prod_unit === 'g')
                                                                - {{ $item->product->prod_weight }}
                                                                {{ $item->product->prod_unit }}
                                                            @endif
                                                        </h3>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm text-gray-800 dark:text-neutral-200 text-right whitespace-nowrap">
                                                @if ($item->product->discounted_price !== null && $item->product->prod_unit !== 'diff_size')
                                                    <div class="flex flex-col items-end">
                                                        <del class="text-xs text-gray-500 dark:text-neutral-400">
                                                            ₱{{ number_format($item->product->prod_price, 2) }}
                                                        </del>
                                                        <span class="text-green-600 dark:text-green-400 text-sm">
                                                            ₱{{ number_format($item->product->discounted_price, 2) }}
                                                        </span>
                                                    </div>
                                                @else
                                                    <div wire:ignore class="text-sm">
                                                        @if (isset($item->variant))
                                                            ₱{{ number_format($item->variant->price, 2) }}
                                                        @else
                                                            ₱{{ number_format($item->product->prod_price, 2) }}
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm text-gray-800 dark:text-neutral-200 text-right">
                                                <div class="flex items-center justify-end space-x-1 md:space-x-2">
                                                    <button type="button"
                                                        wire:click="decreaseQuantity({{ $item->id }})"
                                                        wire:loading.attr="disabled"
                                                        class="px-2 py-1 text-xs md:text-sm font-semibold rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">-</button>
                                                    <p class="text-center w-4 md:w-6 text-sm">
                                                        {{ number_format($item->quantity, 0) }}</p>
                                                    <button type="button"
                                                        wire:click="increaseQuantity({{ $item->id }})"
                                                        wire:loading.attr="disabled"
                                                        class="px-2 py-1 text-xs md:text-sm font-semibold rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">+</button>
                                                </div>
                                            </td>
                                            <td
                                                class="px-3 py-4 text-sm text-gray-800 dark:text-neutral-200 text-right whitespace-nowrap">
                                                @if ($item->product->discounted_price)
                                                    <span class="text-green-600 dark:text-green-400 text-sm">
                                                        ₱{{ number_format($item->product->discounted_price * $item->quantity, 2) }}
                                                    </span>
                                                @else
                                                    <div class="text-sm">
                                                        @if (isset($item->variant))
                                                            ₱{{ number_format($item->variant->price * $item->quantity, 2) }}
                                                        @else
                                                            ₱{{ number_format($item->product->prod_price * $item->quantity, 2) }}
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Checkout Form --}}
            <div class="order-1 lg:order-2">
                <div class="sticky top-4">
                    <h3 class="text-lg md:text-xl font-semibold text-gray-700 dark:text-neutral-400 mb-4">Personal
                        Information</h3>
                    <form wire:key="checkout-form-{{ auth()->id() }}" wire:submit="placeOrder" class="space-y-4">
                        <div class="space-y-3">
                            <fieldset class="mt-3">
                                    <legend class="text-sm text-gray-600 dark:text-neutral-400 mt-3 w-full border-gray-200">
                                        <p class="text-base text-gray-600 dark:text-neutral-400 mb-0 ml-4 w-fit border border-transparent bg-white dark:bg-transparent">Full Name</p>
                            <label for="input-username" class="sr-only">Username</label>
                            <input type="text" id="input-username" value="{{ auth()->user()->name }}"
                                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500"
                                placeholder="Username" readonly>
                                </legend>
                            </fieldset>

                            <fieldset class="mt-3">
                                <legend class="text-sm text-gray-600 dark:text-neutral-400 mt-3 w-full border-gray-200">
                                    <p class="text-base text-gray-600 dark:text-neutral-400 mb-0 ml-4 w-fit border border-transparent bg-white dark:bg-transparent">Email</p>
                            <label for="input-email" class="sr-only">Email</label>
                            <input type="email" id="input-email" value="{{ auth()->user()->email }}"
                                class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500"
                                placeholder="you@site.com" readonly>
                                </legend>
                            </fieldset>
                        </div>

            {{-- Shipping Address Section --}}
            <div>
                <h3 class="text-lg md:text-xl font-semibold text-gray-700 dark:text-neutral-400 mb-3">
                    Shipping Address</h3>
                <div class="space-y-3">
                    <div class="relative" x-data="{ open: false }">
                        <fieldset class="mt-3">
                            <legend class="text-sm text-gray-600 dark:text-neutral-400 mt-3 w-full border-gray-200">
                                <p class="text-base text-gray-600 dark:text-neutral-400 mb-0 ml-4 w-fit border border-transparent bg-white dark:bg-transparent">City</p>
                            <div @click="open = !open"
                                class="border rounded-lg px-4 py-3 cursor-pointer bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 flex justify-between items-center">
                                <span>{{ $selectedCity ? $cities->firstWhere('code', $selectedCity)?->name : 'Select or Search City' }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            </legend>
                        </fieldset>

                        <div x-show="open" @click.outside="open = false" x-transition x-cloak
                            class="absolute z-10 mt-1 w-full bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg shadow-lg max-h-60 overflow-hidden">
                                <div class="relative p-2 border-b border-gray-200 dark:border-neutral-700">
                                    <input type="text" wire:model.live="searchCity"
                                        placeholder="Search City"
                                        class="w-full px-3 py-2 border rounded-md focus:outline-none bg-white dark:bg-neutral-900 text-gray-700 dark:text-neutral-200">
                                    <button type="button"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:text-neutral-400 dark:hover:text-neutral-200"
                                        @click="$wire.set('searchCity', '')">&times;</button>
                                </div>

                            <ul class="max-h-48 overflow-y-auto py-1">
                                @forelse ($cities as $city)
                                    <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-neutral-800 cursor-pointer text-gray-700 dark:text-neutral-200"
                                        wire:click="selectCity('{{ $city->code }}'); open=false">
                                        {{ $city->name }}
                                    </li>
                                @empty
                                    <li class="px-4 py-2 text-gray-500 dark:text-neutral-400 text-center">
                                        No City found</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>


                    @if ($selectedCity)
                        <div class="relative" x-data="{ open: false }">
                        <fieldset class="mt-3">
                            <legend class="text-sm text-gray-600 dark:text-neutral-400 mt-3 w-full border-gray-200">
                                <p class="text-base text-gray-600 dark:text-neutral-400 mb-0 ml-4 w-fit border border-transparent bg-white dark:bg-transparent">Barangay</p>
                            <div @click="open = !open"
                                class="border rounded-lg px-4 py-3 cursor-pointer bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 flex justify-between items-center">
                                <span>{{ $selectedBarangay ? $barangays->firstWhere('name', $selectedBarangay)?->name : 'Select or Search Barangay' }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            </legend>
                        </fieldset>

                            <div x-show="open" @click.outside="open = false" x-transition x-cloak
                                class="absolute z-10 mt-1 w-full bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg shadow-lg max-h-60 overflow-hidden">
                                <div class="relative p-2 border-b border-gray-200 dark:border-neutral-700">
                                    <input type="text" wire:model.live="searchBrgy"
                                        placeholder="Search Barangay"
                                        class="w-full px-3 py-2 border rounded-md focus:outline-none bg-white dark:bg-neutral-900 text-gray-700 dark:text-neutral-200">
                                    <button type="button"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:text-neutral-400 dark:hover:text-neutral-200"
                                        @click="$wire.set('searchBrgy', '')">&times;</button>
                                </div>

                                <ul class="max-h-48 overflow-y-auto py-1">
                                    @forelse ($barangays as $brgy)
                                        <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-neutral-800 cursor-pointer text-gray-700 dark:text-neutral-200"
                                            wire:click="selectBrgy('{{ $brgy->name }}'); open=false">
                                            {{ $brgy->name }}
                                        </li>
                                    @empty
                                        <li
                                            class="px-4 py-2 text-gray-500 dark:text-neutral-400 text-center">
                                            No Barangay Found</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-col items-start pt-2 gap-2">
                        <div class="flex items-start">
                            <input type="checkbox" id="same_as_billing" name="same_as_billing"
                                wire:model.live="same_as_billing"
                                class="shrink-0 mt-1 me-2 border-gray-200 rounded-sm text-blue-600 dark:bg-neutral-800 dark:border-neutral-700">
                            <label for="same_as_billing"
                                class="text-sm text-gray-700 dark:text-neutral-400 cursor-pointer">
                                Is Billing Address same as Shipping Address?</label>
                        </div>
                    </div>


                    @if ($same_as_billing == false)
                        {{-- billing address city --}}
                        <div class="relative" x-data="{ open: false }">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-700 dark:text-neutral-400 mb-3">
                            Billing Address</h3>

                        <fieldset class="mt-3">
                            <legend class="text-sm text-gray-600 dark:text-neutral-400 mt-3 w-full border-gray-200">
                                <p class="text-base text-gray-600 dark:text-neutral-400 mb-0 ml-4 w-fit border border-transparent bg-white dark:bg-transparent">City</p>
                            <div @click="open = !open"
                                class="border rounded-lg px-4 py-3 cursor-pointer bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 flex justify-between items-center">
                                <span>{{ $billing_city ? $bil_cities->firstWhere('code', $billing_city)?->name : 'Select or Search City' }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            </legend>
                        </fieldset>

                            <div x-show="open" @click.outside="open = false" x-transition x-cloak
                                class="absolute z-10 mt-1 w-full bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg shadow-lg max-h-60 overflow-hidden">
                                <div class="relative p-2 border-b border-gray-200 dark:border-neutral-700">
                                    <input type="text" wire:model.live="billingSearchCity"
                                        placeholder="Search City"
                                        class="w-full px-3 py-2 border rounded-md focus:outline-none bg-white dark:bg-neutral-900 text-gray-700 dark:text-neutral-200">
                                    <button type="button"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:text-neutral-400 dark:hover:text-neutral-200"
                                        @click="$wire.set('billingSearchCity', '')">&times;</button>
                                </div>

                                <ul class="max-h-48 overflow-y-auto py-1">
                                    @forelse ($bil_cities as $city)
                                        <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-neutral-800 cursor-pointer text-gray-700 dark:text-neutral-200"
                                            wire:click="bilSelectCity('{{ $city->code }}'); open=false">
                                            {{ $city->name }}
                                        </li>
                                    @empty
                                        <li
                                            class="px-4 py-2 text-gray-500 dark:text-neutral-400 text-center">
                                            No City found</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>

                        @if ($billing_city)
                            {{-- barangay billing address --}}
                            <div class="relative" x-data="{ open: false }">
                            <fieldset class="mt-3">
                                <legend class="text-sm text-gray-600 dark:text-neutral-400 mt-3 w-full border-gray-200">
                                <p class="text-base text-gray-600 dark:text-neutral-400 mb-0 ml-4 w-fit border border-transparent bg-white dark:bg-transparent">Barangay</p>
                                <div @click="open = !open"
                                    class="border rounded-lg px-4 py-3 cursor-pointer bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 flex justify-between items-center">
                                    <span>{{ $billing_brgy ? $bil_barangays->firstWhere('name', $billing_brgy)?->name : 'Select or Search Barangay' }}</span>
                                    <svg class="w-4 h-4 transition-transform"
                                        :class="{ 'rotate-180': open }" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                </legend>
                            </fieldset>

                                <div x-show="open" @click.outside="open = false" x-transition x-cloak
                                    class="absolute z-10 mt-1 w-full bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg shadow-lg max-h-60 overflow-hidden">
                                    <div
                                        class="relative p-2 border-b border-gray-200 dark:border-neutral-700">
                                        <input type="text" wire:model.live="billingSearchBrgy"
                                            placeholder="Search Barangay"
                                            class="w-full px-3 py-2 border rounded-md focus:outline-none bg-white dark:bg-neutral-900 text-gray-700 dark:text-neutral-200">
                                        <button type="button"
                                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:text-neutral-400 dark:hover:text-neutral-200"
                                            @click="$wire.set('billingSearchBrgy', '')">&times;</button>
                                    </div>

                                    <ul class="max-h-48 overflow-y-auto py-1">
                                        @forelse ($bil_barangays as $brgy)
                                            <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-neutral-800 cursor-pointer text-gray-700 dark:text-neutral-200"
                                                wire:click="bilSelectBrgy('{{ $brgy->name }}'); open=false">
                                                {{ $brgy->name }}
                                            </li>
                                        @empty
                                            <li
                                                class="px-4 py-2 text-gray-500 dark:text-neutral-400 text-center">
                                                No Barangay Found</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- Notes --}}
                    <div class="w-full space-y-3">
                        <fieldset class="mt-3 w-full">
                            <legend class="text-xs text-gray-600 dark:text-neutral-400 mt-3 w-full">
                                <p class="text-base text-black-600 dark:text-neutral-400 bg-white mb-0 ml-3 px-1 border border-transparent dark:bg-transparent">Notes</p>
                            <textarea
                                wire:model="notes"
                                class="py-2 px-3 sm:py-3 sm:px-4 block w-full bg-white border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                rows="3" placeholder="Type your notes here..."></textarea>
                            </legend>
                        </fieldset>
                    </div>
                </div>
            </div>
            {{-- End of Shipping Address --}}

                        {{-- Payment Method Section --}}
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-neutral-400 mb-3">Payment Method
                            </h3>
                            <div x-data="{ paymentMethod: @entangle('payment_method') }">
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="radio" id="payment-cod" name="shipping_method"
                                        wire:model="shipping_method" value="COD" class="hidden peer/cod"
                                        @change="paymentMethod = 'cod'" :checked="paymentMethod === 'cod'">
                                    <label for="payment-cod"
                                        class="flex items-center justify-center p-3 w-full bg-white border border-gray-200 rounded-lg text-xs sm:text-sm cursor-pointer transition-colors duration-200 peer-checked/cod:border-amber-500 peer-checked/cod:text-amber-600 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:peer-checked/cod:text-amber-400">
                                        <svg version="1.1" id="ecommerce_1_" class = "w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 115 115" style="enable-background:new 0 0 115 115" xml:space="preserve"><style>.st0{fill:#ffeead}.st7{fill:#71a58a}.st10{fill:#639376}</style><g id="cash_on_delivery_1_"><path class="st7" d="M97.945 69.389H15.99L0 100.186h115z"/><path d="m102.967 90.618-7.716-15.842c-3.111.01-6.181-1.093-6.833-2.654H25.609c-.598 1.566-3.622 2.889-6.733 2.899L11.712 90.91c3.717-.012 5.987 1.925 5.027 4.437h81.355c-1.046-2.505 1.156-4.717 4.873-4.729z" style="fill:#96ceb4"/><path class="st0" d="M74.422 82.072c-1.094-5.164-8.83-8.906-17.388-8.878-8.558.027-16.163 3.819-17.077 8.989-1.035 5.852 6.709 11.168 17.427 11.133 10.718-.035 18.276-5.399 17.038-11.244z"/><path class="st7" d="M64.142 84.513c-.11-1.182-1.258-2.22-3.282-3.07-2.144-.904-3.184-1.34-3.194-1.757-.003-.121.117-.26.394-.26.246-.001.825.657 1.043.656l4.241-.136c.215-.018.333-.088.323-.192-.139-1.5-1.932-2.749-4.699-3.048-.038-.942-.041-1.036-.277-1.035l-2.15.007c-.118 0-.205.064-.205.143l.007.878c-2.781.317-4.334 1.643-4.39 2.938-.054 1.264 1.073 2.323 2.873 3.072 2.546 1.062 3.334 1.479 3.348 1.98.007.253-.284.43-.71.431-.756.003-1.283-.405-1.514-1.078-.065-.171-.163-.209-.357-.208l-4.118.147c-.163.019-.263.077-.267.173-.113 2.318 1.677 3.723 5.232 4.108.011 1.273.012 1.424.287 1.423l2.482-.008c.138-.001.272-.087.269-.173l-.049-1.23c3.132-.39 4.897-1.788 4.713-3.761zM92.986 78.97c-.122-.279-.631-.505-1.133-.504l-12.76.041c-.501.002-.851.23-.777.51.075.281.551.512 1.058.51l12.913-.041c.508-.002.822-.235.699-.516zM94.313 82.008c-.131-.3-.662-.542-1.181-.54l-13.211.042c-.519.002-.879.247-.8.547.08.301.576.549 1.101.547l13.375-.043c.526-.001.847-.251.716-.553zM95.737 85.27c-.141-.322-.695-.583-1.233-.581l-13.694.044c-.538.002-.909.265-.823.587.086.325.603.591 1.148.589l13.871-.044c.544-.002.873-.271.731-.595z"/><g><path class="st7" d="m34.979 78.649-12.76.041c-.501.002-1.003.231-1.116.511-.114.282.208.513.715.511l12.913-.041c.507-.002.976-.235 1.042-.517.065-.28-.292-.507-.794-.505zM34.249 81.657l-13.211.043c-.519.002-1.042.248-1.163.548-.122.302.208.55.733.548l13.375-.043c.525-.002 1.013-.252 1.083-.554.07-.301-.298-.544-.817-.542zM33.466 84.885l-13.694.044c-.538.002-1.084.266-1.214.589-.131.325.207.592.752.59l13.871-.044c.545-.002 1.053-.271 1.128-.596.074-.324-.305-.585-.843-.583z"/></g><g><path class="st7" d="M92.986 78.97c-.122-.279-.631-.505-1.133-.504l-12.76.041c-.501.002-.851.23-.777.51.075.281.551.512 1.058.51l12.913-.041c.508-.002.822-.235.699-.516zM94.313 82.008c-.131-.3-.662-.542-1.181-.54l-13.211.042c-.519.002-.879.247-.8.547.08.301.576.549 1.101.547l13.375-.043c.526-.001.847-.251.716-.553zM95.737 85.27c-.141-.322-.695-.583-1.233-.581l-13.694.044c-.538.002-.909.265-.823.587.086.325.603.591 1.148.589l13.871-.044c.544-.002.873-.271.731-.595z"/><g><path class="st7" d="m34.979 78.649-12.76.041c-.501.002-1.003.231-1.116.511-.114.282.208.513.715.511l12.913-.041c.507-.002.976-.235 1.042-.517.065-.28-.292-.507-.794-.505zM34.249 81.657l-13.211.043c-.519.002-1.042.248-1.163.548-.122.302.208.55.733.548l13.375-.043c.525-.002 1.013-.252 1.083-.554.07-.301-.298-.544-.817-.542zM33.466 84.885l-13.694.044c-.538.002-1.084.266-1.214.589-.131.325.207.592.752.59l13.871-.044c.545-.002 1.053-.271 1.128-.596.074-.324-.305-.585-.843-.583z"/></g><g><path class="st7" d="M97.945 69.389h-17.77c-.014.812-.496 1.744-1.315 2.733h9.558c.652 1.562 3.722 2.664 6.833 2.654l7.716 15.842c-3.717.012-5.919 2.224-4.872 4.73H16.739c.959-2.512-1.311-4.449-5.028-4.437l7.164-15.89c3.111-.01 6.135-1.334 6.733-2.899h8.626c-.548-.765-.867-1.493-.876-2.147-.003-.197.039-.391.072-.586H15.99L0 100.186h115L97.945 69.389z"/><path class="st0" d="M74.422 82.072c-.339-1.599-1.317-3.062-2.758-4.318-3.02 1.797-6.407 3.388-9.41 4.39 1.153.699 1.806 1.494 1.887 2.369.184 1.973-1.581 3.371-4.712 3.757l.049 1.23c.003.086-.131.173-.269.173l-2.482.008c-.275.001-.277-.15-.287-1.422-3.554-.385-5.345-1.79-5.232-4.108.005-.096.104-.154.267-.173l4.118-.147c.194 0 .292.037.357.209.231.673.759 1.081 1.514 1.078.427-.001.717-.178.71-.431-.011-.412-.563-.772-2.164-1.474-3.789-.273-9.263-2.344-13.886-4.929-1.145 1.164-1.918 2.477-2.169 3.9-1.035 5.852 6.709 11.168 17.427 11.133 10.72-.036 18.278-5.4 17.04-11.245z"/><path class="st7" d="M64.142 84.513c-.082-.875-.735-1.67-1.887-2.369-2.018.673-3.862 1.083-5.295 1.103-.301.004-.62-.011-.948-.035 1.601.702 2.152 1.063 2.164 1.474.007.253-.284.43-.71.431-.756.003-1.283-.405-1.514-1.078-.065-.171-.163-.209-.357-.209l-4.118.147c-.163.019-.263.077-.267.173-.114 2.318 1.677 3.723 5.232 4.108.011 1.273.012 1.424.287 1.422l2.482-.008c.138-.001.272-.087.269-.173l-.049-1.23c3.13-.385 4.895-1.783 4.711-3.756z"/><path class="st10" d="M33.431 69.389c-.033.195-.075.389-.072.586.009.654.328 1.381.876 2.147H78.86c.82-.989 1.301-1.921 1.315-2.733H33.431z"/><path class="st7" d="M34.235 72.122c1.414 1.975 4.405 4.212 7.891 6.161 3.017-3.067 8.704-5.07 14.908-5.09 5.908-.019 11.421 1.76 14.63 4.56 3.036-1.805 5.689-3.813 7.196-5.631H34.235z"/><path d="M57.034 73.193c-6.203.02-11.891 2.023-14.908 5.09 4.622 2.585 10.097 4.656 13.886 4.929a65.72 65.72 0 0 0-1.185-.506c-1.8-.749-2.927-1.808-2.873-3.071.055-1.295 1.608-2.621 4.39-2.938l-.007-.878c-.001-.079.087-.142.205-.143l2.15-.007c.236-.001.239.093.277 1.035 2.766.299 4.559 1.548 4.699 3.049.01.104-.108.174-.323.192l-4.241.136c-.217.001-.796-.657-1.043-.656-.277.001-.397.14-.394.261.01.417 1.05.854 3.194 1.758.526.22.99.454 1.395.7 3.002-1.002 6.389-2.593 9.41-4.39-3.212-2.801-8.725-4.58-14.632-4.561z" style="fill:#d3c089"/><path class="st10" d="M58.968 76.705c-.038-.942-.041-1.036-.277-1.035l-2.15.007c-.118 0-.205.064-.205.143l.007.878c-2.781.317-4.334 1.643-4.39 2.938-.054 1.263 1.073 2.323 2.873 3.071.455.189.836.353 1.185.506.328.023.647.039.948.035 1.433-.02 3.277-.43 5.295-1.103-.405-.246-.869-.48-1.395-.7-2.144-.904-3.184-1.34-3.194-1.758-.003-.121.117-.259.394-.261.247-.001.825.657 1.043.656l4.241-.136c.215-.018.333-.088.323-.192-.139-1.501-1.932-2.75-4.698-3.049z"/></g></g><g><path d="M56.066 14.816c-12.93.18-23.264 10.863-23.083 23.86.181 12.997 16.513 36.801 23.928 36.697 6.904-.096 23.076-24.353 22.895-37.35-.181-12.997-10.81-23.387-23.74-23.207z" style="fill:#ff6f69"/><ellipse transform="rotate(-90.802 56.398 38.737)" class="st0" cx="56.4" cy="38.737" rx="12.245" ry="12.181"/></g></g></svg>
                                        Cash on Delivery
                                    </label>

                                    <input type="radio" id="payment-ewallet" name="shipping_method"
                                        wire:model="shipping_method" value="e-wallet" class="hidden peer/ewallet"
                                        @change="paymentMethod = 'ewallet'" :checked="paymentMethod === 'ewallet'">
                                    <label for="payment-ewallet"
                                        class="flex items-center justify-center p-3 w-full bg-white border border-gray-200 rounded-lg text-xs sm:text-sm cursor-pointer transition-colors duration-200 peer-checked/ewallet:border-amber-500 peer-checked/ewallet:text-amber-600 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:peer-checked/ewallet:text-amber-400">
                                        <svg version="1.1" id="ecommerce_1_" class = "w-6 h-6 mr-2"xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 115 115" style="enable-background:new 0 0 115 115" xml:space="preserve"><style>.st0{fill:#ffeead}.st1{fill:#c9b77d}.st4{fill:#96ceb4}.st7{fill:#71a58a}</style><g id="wallet_1_"><path class="st4" d="M75.198 1.546a3.424 3.424 0 0 0-4.741-.985l-45.84 30.07 18.205-6.55a13.758 13.758 0 0 1 10.279-3.698l15.844-5.701c-.007-.01-.016-.016-.023-.026-.812-1.209-.872-3.016.405-4.313l-.588-.875c-.053-.08-.049-.175.015-.218l1.161-.78c.127-.086.192.01.822.949 1.667-.681 3.37-.07 4.31 1.33.064.095.043.202-.057.292l-2.105 1.576c-.111.075-.804-.338-.931-.252-.143.096-.121.266-.046.378.165.245.584.348 1.266.417l7.801-2.807-5.777-8.807z"/><path class="st7" d="M31.381 69.438a3.42 3.42 0 0 1-1.172.191 3.418 3.418 0 0 0 4.389.551l6.414-4.208-9.631 3.466zM16.166 37.336a3.401 3.401 0 0 1-.185-1.039l-2.524 1.656a3.424 3.424 0 0 0-.985 4.741l12.452 18.983-8.758-24.341z"/><path class="st0" d="M49.021 20.736a13.697 13.697 0 0 0-6.199 3.345l10.279-3.698a13.758 13.758 0 0 0-4.08.353zM72.886 12.617l2.105-1.576c.101-.091.121-.197.057-.292-.941-1.4-2.644-2.011-4.31-1.33-.63-.939-.695-1.034-.822-.949l-1.161.78c-.064.043-.068.138-.015.218l.588.875c-1.277 1.296-1.217 3.103-.405 4.313.007.01.016.016.023.026l4.23-1.522c-.683-.07-1.102-.172-1.266-.417-.075-.111-.097-.281.046-.378.126-.086.819.327.93.252z"/><path class="st4" d="m29.857 69.195-4.933-7.52 2.046 5.686a3.438 3.438 0 0 0 3.239 2.268 3.253 3.253 0 0 1-.352-.434z"/><path class="st7" d="M92.583 28.048 80.975 10.353l-7.801 2.807c.379.039.818.071 1.393.105 1.489.085 2.612.623 3.275 1.61 1.069 1.591.904 3.271-.383 4.552l.62.923a.165.165 0 0 1-.042.213l-1.146.77c-.127.085-.202-.026-.843-.981-1.874.82-3.486.31-4.747-1.568-.053-.08-.038-.159.031-.228l1.946-1.469c.095-.064.165-.064.293.057.485.482.964.645 1.33.399a.402.402 0 0 0 .115-.585c-.278-.414-.895-.507-2.761-.57-1.333-.043-2.541-.581-3.311-1.706L53.1 20.383c5.881.37 11.086 4.513 12.53 10.542 1.773 7.4-2.788 14.837-10.189 16.61s-14.837-2.788-16.61-10.189c-1.196-4.99.497-9.989 3.99-13.265l-18.205 6.55-8.636 5.665c.013.346.062.695.185 1.039l8.758 24.34 4.933 7.52c.104.159.227.298.352.434.389.001.784-.052 1.172-.191l9.631-3.465 50.587-33.184a3.424 3.424 0 0 0 .985-4.741z"/><path class="st1" d="M65.631 30.925c-1.445-6.029-6.649-10.172-12.53-10.542l-10.279 3.698c-3.493 3.276-5.186 8.275-3.99 13.265 1.773 7.4 9.21 11.962 16.61 10.189s11.962-9.21 10.189-16.61zM77.46 19.426c1.287-1.28 1.451-2.961.383-4.552-.663-.987-1.786-1.525-3.275-1.61a32.504 32.504 0 0 1-1.393-.105l-4.23 1.522c.77 1.125 1.978 1.663 3.311 1.706 1.866.062 2.483.156 2.761.57a.402.402 0 0 1-.115.585c-.366.246-.845.083-1.33-.399-.128-.122-.197-.121-.293-.057l-1.946 1.469c-.069.069-.084.149-.031.228 1.261 1.878 2.873 2.387 4.747 1.568.641.955.716 1.066.843.981l1.146-.77a.165.165 0 0 0 .042-.213l-.62-.923z"/><path class="st4" d="M88.161 13.934a3.446 3.446 0 0 0-4.41-2.076l-58.254 20.96h20.956c2.482-3.756 6.738-6.237 11.577-6.237s9.094 2.481 11.577 6.237h15.079l-.103-.273c-2.027.363-3.486-.514-4.28-2.648-.034-.091 0-.165.084-.216l2.25-.982c.109-.04.176-.024.273.125.362.586.793.858 1.209.703a.406.406 0 0 0 .25-.546c-.175-.47-.757-.706-2.569-1.205-1.307-.358-2.373-1.176-2.858-2.478-.512-1.374-.146-3.158 1.408-4.127l-.37-.995c-.034-.091-.007-.183.066-.21l1.32-.491c.145-.054.185.055.582 1.122 1.792-.276 3.316.722 3.908 2.313.04.108-.005.208-.125.273L83.3 24.23c-.127.047-.708-.519-.853-.465-.163.061-.181.232-.134.359.162.434.927.664 2.482 1.135 1.437.432 2.411 1.223 2.829 2.344.673 1.808.118 3.415-1.443 4.367l.315.847h8.46l-6.795-18.883z"/><path class="st0" d="M58.03 26.581c-4.839 0-9.094 2.481-11.577 6.237h23.153c-2.482-3.756-6.737-6.237-11.576-6.237zM87.624 27.604c-.417-1.121-1.391-1.912-2.829-2.344-1.555-.472-2.32-.701-2.482-1.135-.047-.127-.029-.298.134-.359.145-.054.726.512.853.465l2.43-1.049c.12-.065.165-.164.125-.273-.592-1.592-2.117-2.589-3.908-2.313-.397-1.067-.438-1.176-.582-1.122l-1.32.491c-.072.027-.099.119-.066.21l.37.995c-1.554.97-1.92 2.753-1.408 4.127.485 1.302 1.551 2.12 2.858 2.478 1.813.499 2.394.735 2.569 1.205a.405.405 0 0 1-.25.546c-.416.155-.847-.117-1.209-.703-.097-.149-.164-.165-.273-.125l-2.25.982c-.084.051-.118.126-.084.216.794 2.134 2.253 3.012 4.28 2.648l.103.273h1.811l-.315-.847c1.561-.951 2.116-2.558 1.443-4.366z"/><path class="st7" d="m98.965 43.96-4.009-11.142h-8.46l.075.201c.027.072-.018.172-.091.199l-1.302.485c-.129.048-.194-.088-.493-.885H69.606a13.8 13.8 0 0 1 2.296 7.635c0 7.661-6.211 13.872-13.872 13.872s-13.872-6.211-13.872-13.872c0-2.823.848-5.445 2.296-7.635H25.497l-6.326 2.276a3.446 3.446 0 0 0-2.076 4.41L27.899 69.53a3.447 3.447 0 0 0 4.411 2.076l64.58-23.237a3.445 3.445 0 0 0 2.075-4.409z"/><path class="st1" d="M69.606 32.818H46.453a13.8 13.8 0 0 0-2.296 7.635c0 7.661 6.211 13.872 13.872 13.872 7.662 0 13.872-6.211 13.872-13.872a13.79 13.79 0 0 0-2.295-7.635zM86.497 32.818h-1.811c.298.797.364.933.493.885l1.302-.485a.167.167 0 0 0 .091-.199l-.075-.201z"/><g><path d="M94.959 35.371H17.263c-5.287 0-9.612 4.325-9.612 9.612v60.406c0 5.287 4.325 9.612 9.612 9.612h77.696c5.287 0 9.612-4.325 9.612-9.612V44.983c0-5.287-4.326-9.612-9.612-9.612z" style="fill:#99734a"/></g><g><path d="M102.84 67.625H79.231a6.974 6.974 0 0 0-6.974 6.974v10.554a6.974 6.974 0 0 0 6.974 6.974h23.609c.613 0 1.195-.125 1.731-.342V67.967a4.597 4.597 0 0 0-1.731-.342z" style="fill:#825e3b"/></g><g><path class="st1" d="M102.84 64.073H79.231a6.974 6.974 0 0 0-6.974 6.974v10.554a6.974 6.974 0 0 0 6.974 6.974h23.609a4.617 4.617 0 0 0 4.617-4.617V68.69a4.617 4.617 0 0 0-4.617-4.617z"/></g><g><path class="st1" d="M12.871 44.095h-4.44a.887.887 0 1 0 0 1.776h4.44a.887.887 0 1 0 0-1.776zM32.04 44.095h-9.584a.887.887 0 1 0 0 1.776h9.584a.887.887 0 1 0 0-1.776zm19.169 0h-9.585a.887.887 0 1 0 0 1.776h9.585a.887.887 0 1 0 0-1.776zm38.336 0h-9.584a.887.887 0 1 0 0 1.776h9.584a.887.887 0 1 0 0-1.776zm-19.168 0h-9.584a.887.887 0 1 0 0 1.776h9.584a.887.887 0 1 0 0-1.776zM103.569 44.095h-4.44a.887.887 0 1 0 0 1.776h4.44a.887.887 0 1 0 0-1.776z"/></g><g><path class="st1" d="M12.871 104.949h-4.44a.887.887 0 1 0 0 1.776h4.44a.887.887 0 1 0 0-1.776zM51.209 104.949h-9.585a.887.887 0 1 0 0 1.776h9.585a.887.887 0 1 0 0-1.776zm-19.169 0h-9.584a.887.887 0 1 0 0 1.776h9.584a.887.887 0 1 0 0-1.776zm57.505 0h-9.584a.887.887 0 1 0 0 1.776h9.584a.887.887 0 1 0 0-1.776zm-19.168 0h-9.584a.887.887 0 1 0 0 1.776h9.584a.887.887 0 1 0 0-1.776zM103.569 104.949h-4.44a.887.887 0 1 0 0 1.776h4.44a.887.887 0 1 0 0-1.776z"/></g><g><circle cx="83.564" cy="78.217" r="6.293" style="fill:#c1821e"/></g><g><circle cx="83.564" cy="75.936" r="6.293" style="fill:#d6a041"/></g><g><circle cx="85.57" cy="73.93" r="2.006" style="fill:#ffcc5c"/></g></g></svg>
                                        E-Wallets
                                    </label>
                                </div>

                                <div class="mt-4 space-y-3" x-show="paymentMethod === 'ewallet'" x-cloak>
                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach ([['id' => 'payment-gcash', 'value' => 'gcash', 'img' => 'imgs/gcash.png', 'label' => 'GCash'], ['id' => 'payment-card', 'value' => 'card', 'img' => 'imgs/card.png', 'label' => 'Visa/Mastercard'], ['id' => 'payment-paymaya', 'value' => 'paymaya', 'img' => 'imgs/paymaya.png', 'label' => 'Paymaya'], ['id' => 'payment-grabpay', 'value' => 'grab_pay', 'img' => 'imgs/grabpay.png', 'label' => 'GrabPay']] as $payment)
                                            <div
                                                class="relative flex items-center p-2 border rounded-lg bg-white dark:bg-neutral-800 dark:border-neutral-700">
                                                <input id="{{ $payment['id'] }}" name="payment_method"
                                                    type="radio" value="{{ $payment['value'] }}"
                                                    wire:model.live="shipping_method"
                                                    class="border-gray-200 rounded-full text-amber-600"
                                                    :disabled="paymentMethod !== 'ewallet'">
                                                <label for="{{ $payment['id'] }}"
                                                    class="ml-2 flex items-center cursor-pointer">
                                                    <img src="{{ asset($payment['img']) }}" class="w-6 h-6 mr-1">
                                                    <span
                                                        class="text-xs text-gray-700 dark:text-neutral-300">{{ $payment['label'] }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card Details --}}
                        @if ($shipping_method === 'card')
                            <div
                                class="p-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                <h3 class="font-medium text-sm text-gray-800 mb-3 dark:text-neutral-200">Card Details
                                </h3>

                                <div class="space-y-3">
                                    <input type="text" wire:model.blur="card_name" id="card_name"
                                        class="block w-full px-3 py-2.5 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
                                        placeholder="Name on Card">
                                    @error('card_name')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror

                                    <input type="text" wire:model.blur="card_number" id="card_number"
                                        class="block w-full px-3 py-2.5 text-sm border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
                                        placeholder="1234 5678 9012 3456">
                                    @error('card_number')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror

                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <span class="block mb-1 text-xs text-gray-600 dark:text-neutral-500">Exp
                                                Month</span>
                                            <select wire:model.blur="expiration_month" id="expiration_month"
                                                class="block w-full px-2 py-2 text-xs border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <option value="">Month</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}">
                                                        {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                                @endfor
                                            </select>
                                            @error('expiration_month')
                                                <span class="text-xs text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <span
                                                class="block mb-1 text-xs text-gray-600 dark:text-neutral-500">Year</span>
                                            <select wire:model.blur="expiration_year" id="expiration_year"
                                                class="block w-full px-2 py-2 text-xs border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <option value="">Year</option>
                                                @for ($i = date('Y'); $i <= date('Y') + 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('expiration_year')
                                                <span class="text-xs text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <span
                                                class="block mb-1 text-xs text-gray-600 dark:text-neutral-500">CVV</span>
                                            <input type="text" wire:model.blur="cvv" id="cvv"
                                                class="block w-full px-2 py-2 text-xs border-gray-200 rounded-lg focus:border-amber-500 focus:ring-amber-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
                                                placeholder="123">
                                            @error('cvv')
                                                <span class="text-xs text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Payment Summary --}}
                        <div
                            class="bg-white dark:bg-neutral-900 p-4 rounded-lg border border-gray-200 dark:border-neutral-700">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-neutral-400 mb-3">Payment Summary
                            </h3>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600 dark:text-neutral-400">Product Subtotal:</span>
                                    <span
                                        class="text-sm text-gray-800 dark:text-neutral-200">₱{{ number_format($itemsTotal, 2) }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600 dark:text-neutral-400">Shipping:</span>
                                    <span
                                        class="text-sm {{ $totalShipping > 0 ? 'text-gray-800 dark:text-neutral-200' : 'text-green-500' }}">
                                        {{ $totalShipping > 0 ? '₱' . number_format($totalShipping, 2) : 'Free Shipping' }}
                                    </span>
                                </div>

                                <div class="border-t border-gray-200 dark:border-neutral-700 pt-2 mt-2">
                                    <div class="flex justify-between">
                                        <span class="font-semibold text-gray-800 dark:text-neutral-200">Total:</span>
                                        <span
                                            class="font-semibold text-gray-800 dark:text-neutral-200">₱{{ number_format($subtotal, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Error Messages --}}
                        @if ($errors->any())
                            <div
                                class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg dark:bg-red-900/20 dark:border-red-800 dark:text-red-400">
                                <ul class="list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- @foreach ($cities as $city)
                        {{$city->name}} -- {{$city->code}}

                        @endforeach --}}

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-3 pt-4">
                            <button type="button" wire:click.prevent="cancelOrder"
                                class="px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 transition-colors">Cancel
                                Order</button>
                            <x-button type="submit" wire:target="placeOrder" class="flex-1 justify-center"
                                wire:loading.attr="disabled">
                                <span wire:loading.flex wire:target="placeOrder" class="items-center">
                                    <svg class="animate-spin h-4 w-4 mr-2 text-white"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z">
                                        </path>
                                    </svg>
                                </span>
                                Place Order
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    [x-cloak] {
        display: none !important;
    }
</style> --}}
