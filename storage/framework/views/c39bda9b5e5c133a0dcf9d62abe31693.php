
<div>
    <button type="button"
    class="relative inline-flex items-center gap-x-2 text-sm font-medium rounded-lg focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
    aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-offcanvas-custom-backdrop-color"
    data-hs-overlay="#hs-offcanvas-custom-backdrop-color">

    <!-- Cart Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 font-medium text-amber-400 dark:text-neutral-400 dark:hover:text-neutral-500 hover:text-yellow-600 -mr-1">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
    </svg>




    <!-- Cart Count -->
    <!--[if BLOCK]><![endif]--><?php if($this->cartCount == 0 || $this->cartCount > 0): ?>
        <span class="mb-11 -mr-5 -translate-x-1/2 translate-y-1/2 bg-yellow-500 text-white dark:bg-white dark:bg-black dark:text-black rounded-full text-xs font-bold px-2 py-0"
        wire:poll.100ms>
        <?php echo e($this->cartCount); ?>

        </span>

    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

</button>
</div>
<?php /**PATH C:\laragon\www\sidlak-vet-appointment-and-pet-shop\resources\views/livewire/ecommerce/cart-count.blade.php ENDPATH**/ ?>