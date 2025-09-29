<div>
    
    

    
    <div class="flex items-center mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-6 -mb-6">

        <!-- Sorting Menu -->
        <div class="hs-dropdown relative inline-flex" wire:ignore.self x-data="{ showSortOptions: false }">
            <button id="hs-dropdown-slideup-animation" type="button"
                class="hs-dropdown-toggle py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                aria-haspopup="menu" aria-expanded="false" aria-controls="hs-dropdown-slideup-animation"
                aria-label="Dropdown" data-hs-dropdown-toggle>
                <span><?php echo e($selectedCatName ? ucwords($selectedCatName) : 'All Categories'); ?>

                    (<?php echo e(strtoupper($sortBy)); ?>)</span>
                <svg @click.stop="showSortOptions = !showSortOptions" class="hs-dropdown-open:rotate-180 size-4"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </button>

            <!-- Sorting options that appear when clicking the chevron -->
            <div x-show="showSortOptions" @click.outside="showSortOptions = false"
                class="absolute left-full top-0 right-2 bg-white dark:bg-neutral-800 shadow-md rounded-lg border dark:border-neutral-700 min-w-40 z-20 ml-3"
                style="display: none">
                
                <a wire:click.prevent="arrangeBy('asc')" @click="showSortOptions = false"
                    class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 cursor-pointer whitespace-nowrap">
                    Price: Low to High (ASC)
                </a>
                <a wire:click.prevent="arrangeBy('desc')" @click="showSortOptions = false"
                    class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 cursor-pointer whitespace-nowrap">
                    Price: High to Low (DESC)
                </a>
            </div>

            <!-- Original dropdown menu for categories (unchanged) -->
            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10 duration-300 mt-2 min-w-60 bg-white shadow-md rounded-lg dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
                role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-slideup-animation"
                wire:ignore.self>
                <div class="p-1 space-y-0.5">
                    <div class="relative">
                        <div x-on:click.stop>
                            <input type="text" name="searchCat" id="searchCat" wire:model.live="searchCat"
                                placeholder="Search category..."
                                class="w-full px-3 py-2 text-sm border rounded-md focus:ring focus:ring-gray-300 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white pr-10">
                        </div>

                        <!--[if BLOCK]><![endif]--><?php if($searchCat): ?>
                            <button type="button" wire:click="$set('searchCat', '') " x-on:click.stop
                                class="absolute inset-y-0 end-2 flex items-center text-gray-400 hover:text-gray-600 dark:text-white/60 dark:hover:text-white">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="max-h-60 overflow-y-auto">
                        <!-- All Categories -->
                        <a wire:click.prevent="filterByCategoryAndOrder(null, '<?php echo e($sortBy); ?>')"
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 cursor-pointer">
                            All Categories
                        </a>

                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $categories->filter(fn($cat) => stripos($cat->prod_cat_name, $searchCat ?? '') !== false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div wire:key="<?php echo e($prodCat->id); ?>">
                                <a wire:click.prevent="filterByCategoryAndOrder(<?php echo e($prodCat->id); ?>, '<?php echo e($sortBy); ?>')"
                                    class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 cursor-pointer">
                                    <?php echo e(ucwords($prodCat->prod_cat_name)); ?>

                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-sm text-gray-800 dark:text-neutral-400 px-3 py-2">
                                No categories found.
                            </p>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Sorting Menu -->




        <!-- Search Bar -->
        <div class="w-80 ml-3">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
                    <svg class="shrink-0 size-4 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                </div>
                <input name="query" id="query" wire:model.live="query"
                    class="py-3 ps-10 pe-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    type="text" placeholder="Search Products">
                <!--[if BLOCK]><![endif]--><?php if($query): ?>
                    <button type="button" wire:click="$set('query', '')"
                        class="absolute inset-y-0 end-0 flex items-center pe-3 text-gray-400 hover:text-gray-600 dark:text-white/60 dark:hover:text-white">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->


            </div>
        </div>
        <!-- End of Search Bar -->
    </div>



    
    



    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto scroll-visible">
        <!-- Grid -->
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4">

            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $this->getProducts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div wire:key="product-<?php echo e($product->id); ?>"
                    class="group flex flex-col border border-gray-200 hover:border-transparent hover:shadow-lg focus:outline-none focus:border-transparent focus:shadow-lg transition duration-300 rounded-xl p-4 dark:border-neutral-700 dark:hover:border-transparent dark:hover:shadow-black/40 dark:focus:border-transparent dark:focus:shadow-black/40">
                    <p
                        class="text-xs flex justify-between items-center gap-x-2 text-green-500 dark:text-green-400 mb-2">
                        
                        <!--[if BLOCK]><![endif]--><?php if($product->discounted_price !== null && $product->prod_unit !== 'diff_size'): ?>
                            <?php echo e(ucwords($product->productDiscounts->first()?->discount_name)); ?>

                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <!--[if BLOCK]><![endif]--><?php if($product->prod_unit !== 'diff_size'): ?>
                            <!--[if BLOCK]><![endif]--><?php if($product->prod_quantity < 1): ?>
                                <span class="text-red-500">Out of Stock</span>
                            <?php elseif($product->prod_quantity <= 10): ?>
                                <span class="text-orange-500">Low in Stock <?php echo e((int) $product->prod_quantity); ?>

                                    left
                                </span>
                            <?php else: ?>
                                <span class="text-green-500">In Stock</span>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </p>


                    <div class="aspect-w-16 aspect-h-11">
                        <a wire:navigate href="<?php echo e(route('page.singleProd', ['prod_slug' => $product->prod_slug])); ?>">

                            

                            
                            
                            
                            <img class="w-full h-[180px] md:h-[200px] lg:h-[250px] object-cover rounded-xl"
                                src="<?php echo e($product->primary_image ? asset(Storage::url($product->primary_image->url)) : asset('default-image.jpg')); ?>"
                                alt="<?php echo e($product->prod_slug); ?>">
                        </a>
                    </div>
                    <div class="flex flex-col flex-grow mt-4">
                        <h5 class="text-md  text-gray-800 dark:text-neutral-300 dark:group-hover:text-white">
                            <?php echo e(ucwords($product->prod_name)); ?>

                            <!--[if BLOCK]><![endif]--><?php if($product->prod_unit == 'kg'): ?>
                                <?php echo e(' - ' . number_format($product->prod_weight, 2) . $product->prod_unit); ?>

                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            <!--[if BLOCK]><![endif]--><?php if($product->prod_unit == 'g'): ?>
                                <?php echo e(' - ' . number_format($product->prod_weight, 2) . $product->prod_unit); ?>

                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </h5>
                        <p class="mt-5 text-gray-600 dark:text-neutral-400"></p>
                        <div class="flex flex-wrap items-center justify-between gap-x-4 overflow-hidden max-w-full">
                            

                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-300">
                                <!--[if BLOCK]><![endif]--><?php if($product->prod_unit !== 'diff_size'): ?>
                                    <!--[if BLOCK]><![endif]--><?php if($product->discounted_price !== null): ?>
                                        <del class="text-gray-500 dark:text-neutral-400">
                                            ₱<?php echo e(number_format($product->prod_price, 2) . ' '); ?>

                                        </del>
                                        <span class="text-sm font-semibold text-gray-800 dark:text-neutral-300">
                                            ₱<?php echo e(number_format($product->discounted_price, 2)); ?>

                                        </span>
                                        <span class="text-green-600 font-semibold ml-2">
                                            <?php echo e($product->discount_label); ?>

                                        </span>
                                    <?php else: ?>
                                        ₱<?php echo e(number_format($product->prod_price, 2)); ?>

                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                
                            </p>
                        </div>

                    </div>
                    <div class="mt-auto flex items-center gap-x-3">




                        <div class="mt-3 ">
                            <!--[if BLOCK]><![endif]--><?php if($product->prod_quantity > 0 && $product->prod_unit != 'diff_size'): ?>
                                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('ecommerce.add-to-cart-form', ['productId' => $product->id,'product_id' => $product->id]);

$__html = app('livewire')->mount($__name, $__params, 'add-to-cart-'.e($product->id).'', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                            <!--[if BLOCK]><![endif]--><?php if($product->prod_unit == 'diff_size'): ?>
                                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('ecommerce.product-variant', ['productId' => $product->id,'product_id' => $product->id]);

$__html = app('livewire')->mount($__name, $__params, 'lw-4241084954-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                            <!--[if BLOCK]><![endif]--><?php if($product->prod_quantity < 1): ?>
                                
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>





                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500 dark:text-neutral-400 text-lg">No products available.</p>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->



        </div>

    </div>

    <div class="mt-2 flex justify-start ml-6">
        <?php echo e($this->getProducts()->links('vendor.pagination.shop-pagination')); ?>

    </div>




</div>
<?php /**PATH C:\laragon\www\sidlak-vet-appointment-and-pet-shop\resources\views/livewire/ecommerce/shop.blade.php ENDPATH**/ ?>