<section class="relative z-50 isolate overflow-visible max-w-full px-4 py-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6 auto-rows-[420px]">
    @forelse($products as $product)
        <x-product-card :image="$product['image'] ?? '/images/placeholder.png'"
                        :title="$product['title'] ?? 'Product Title'"
                        :subtitle="$product['subtitle'] ?? 'Product Subtitle'"
                        :price="$product['price'] ?? '0'">
            {!! $product['sizes'] ?? '' !!}
        </x-product-card>
    @empty
        <!-- Fallback Example Card -->
        <x-product-card image="/images/sho3.png" title="MEN'S DASHER NZ" subtitle="Comfortable Running Shoes" price="140">
            <div class="grid grid-cols-5 gap-2">
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">6</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">7</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">8</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">10</div>
            </div>
        </x-product-card>

         <x-product-card image="/images/sho7.png" title="MEN'S DASHER NZ" subtitle="Comfortable Running Shoes" price="140">
            <div class="grid grid-cols-5 gap-2">
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">6</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">7</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">8</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">10</div>
            </div>
        </x-product-card>


         <x-product-card image="/images/sho6.png" title="MEN'S DASHER NZ" subtitle="Comfortable Running Shoes" price="140">
            <div class="grid grid-cols-5 gap-2">
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">6</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">7</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">8</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">10</div>
            </div>
        </x-product-card>

         <x-product-card image="/images/yellow1.webp" title="MEN'S DASHER NZ" subtitle="Comfortable Running Shoes" price="140"
         link="/men/shop/men/detailshoes">
            <div class="grid grid-cols-5 gap-2">
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">6</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">7</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">8</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">9</div>
                <div class="h-10 border border-gray-300 rounded-md flex items-center justify-center hover:bg-gray-200">10</div>
            </div>
        </x-product-card>

    @endforelse
</section>
