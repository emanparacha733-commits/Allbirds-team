@extends('admin.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
            <p class="mt-2 text-sm text-gray-600">Update the details for <strong>{{ $product->name }}</strong></p>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
              class="bg-white shadow-lg rounded-xl p-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- Basic Info Section --}}
            <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 pb-2 border-b">Basic Information</h2>

                {{-- Product Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="e.g., Men's Dasher NZ">
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Product description...">{{ old('description', $product->description) }}</textarea>
                </div>

                {{-- Product Image --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Product Image
                    </label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           onchange="previewImage(event)">
                    <img id="imagePreview" class="mt-4 rounded-lg max-h-48" 
                         src="{{ $product->image ? asset('storage/' . $product->image) : '' }}" alt="Preview">
                </div>
            </div>

            {{-- Category & Type Section --}}
            <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 pb-2 border-b">Category & Type</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Type --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Type <span class="text-red-500">*</span>
                        </label>
                        <select name="type" id="typeSelect" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Type</option>
                            <option value="shoes"       {{ old('type', $product->type) == 'shoes'       ? 'selected' : '' }}>Shoes</option>
                            <option value="socks"       {{ old('type', $product->type) == 'socks'       ? 'selected' : '' }}>Socks</option>
                            <option value="apparel"     {{ old('type', $product->type) == 'apparel'     ? 'selected' : '' }}>Apparel</option>
                            <option value="accessories" {{ old('type', $product->type) == 'accessories' ? 'selected' : '' }}>Accessories</option>
                        </select>
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Gender <span class="text-red-500">*</span>
                        </label>
                        <select name="gender" id="genderSelect" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Gender</option>
                            <option value="men"    {{ old('gender', $product->gender) == 'men'    ? 'selected' : '' }}>Men</option>
                            <option value="women"  {{ old('gender', $product->gender) == 'women'  ? 'selected' : '' }}>Women</option>
                            <option value="unisex" {{ old('gender', $product->gender) == 'unisex' ? 'selected' : '' }}>Unisex</option>
                        </select>
                    </div>

                    {{-- Category (dynamic) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select name="category" id="categorySelect" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="{{ old('category', $product->category) }}">{{ $product->category ?? 'Select Type & Gender' }}</option>
                        </select>
                        <p id="categoryHint" class="mt-1 text-xs text-gray-400">Choose a type and gender to see options</p>
                    </div>
                </div>
            </div>

            {{-- Sizes Section (shown only for shoes) --}}
            <div id="sizesSection" class="space-y-6 hidden">
                <h2 class="text-xl font-semibold text-gray-900 pb-2 border-b">Sizes & Stock</h2>
                <p class="text-sm text-gray-500">Enter the stock quantity for each size. Leave blank or 0 for unavailable sizes.</p>
                <div id="sizesGrid" class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                    {{-- JS will populate with old stock --}}
                </div>
            </div>

            {{-- Color Section --}}
            <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 pb-2 border-b">Color Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Color Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Color Name</label>
                        <input type="text" name="color_name" value="{{ old('color_name', $product->color_name) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="e.g., Natural White">
                    </div>

                    {{-- Color Hex --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Color Code</label>
                        <div class="flex gap-2">
                            <input type="color" name="color_hex" id="colorPicker" value="{{ old('color_hex', $product->color_hex ?? '#000000') }}"
                                   class="h-10 w-20 border border-gray-300 rounded-lg cursor-pointer">
                            <input type="text" id="colorHexText" value="{{ old('color_hex', $product->color_hex ?? '#000000') }}"
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg"
                                   placeholder="#000000" readonly>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pricing Section --}}
            <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 pb-2 border-b">Pricing</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Regular Price --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Regular Price <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-2 text-gray-500">$</span>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" required
                                   class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0.00">
                        </div>
                    </div>

                    {{-- Sale Price --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sale Price (Optional)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-2 text-gray-500">$</span>
                            <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" step="0.01"
                                   class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0.00">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Product Flags --}}
            <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 pb-2 border-b">Product Flags</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="is_new" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm font-medium text-gray-700">Mark as New Arrival</span>
                    </label>

                    <label class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm font-medium text-gray-700">Featured Product</span>
                    </label>

                    <label class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="on_sale" value="1" {{ old('on_sale', $product->on_sale) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm font-medium text-gray-700">On Sale</span>
                    </label>
                </div>
            </div>

            {{-- Submit Buttons --}}
            <div class="flex gap-4 pt-6 border-t">
                <button type="submit"
                        class="flex-1 bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-800 transition">
                    Update Product
                </button>
                <a href="{{ route('admin.products.index') }}"
                   class="px-6 py-3 border border-gray-300 rounded-lg font-semibold hover:bg-gray-50 transition">
                    Cancel
                </a>
            </div>
        </form>

    </div>
</div>

<script>
    // Convert PHP sizes array to JS object
    const productSizes = {!! json_encode($product->sizes ?? []) !!};

    function updateSizes() {
        const type   = typeSelect.value;
        const gender = genderSelect.value;

        sizesGrid.innerHTML = '';

        if (type === 'shoes' && gender && shoeSizes[gender]) {
            sizesSection.classList.remove('hidden');
            shoeSizes[gender].forEach(size => {
                const div = document.createElement('div');
                div.className = 'flex flex-col items-center gap-1';
                
                // Get saved value or 0
                const value = productSizes[size] ?? 0;

                div.innerHTML = `
                    <label class="text-xs font-semibold text-gray-600">US ${size}</label>
                    <input type="number" name="sizes[${size}]" min="0" value="${value}"
                           class="w-full text-center px-2 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                `;
                sizesGrid.appendChild(div);
            });
        } else {
            sizesSection.classList.add('hidden');
        }
    }
</script>

@endsection
