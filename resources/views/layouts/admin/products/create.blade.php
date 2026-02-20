@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Add New Product</h1>
            <p class="mt-2 text-sm text-gray-600">Fill in the details below to add a new product to your store</p>
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
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white shadow-lg rounded-xl p-8 space-y-6">
            @csrf

            {{-- Basic Info Section --}}
            <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 pb-2 border-b">Basic Information</h2>

                {{-- Product Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="e.g., Men's Dasher NZ">
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Product description...">{{ old('description') }}</textarea>
                </div>

                {{-- Product Image --}}
               {{-- Product Images --}}
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Main Image <span class="text-red-500">*</span></label>
        <input type="file" name="image" accept="image/*" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
               onchange="previewImage(event,'prev1')">
        <img id="prev1" class="mt-2 rounded-lg max-h-40 hidden">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Extra Image 2</label>
        <input type="file" name="image_2" accept="image/*"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
               onchange="previewImage(event,'prev2')">
        <img id="prev2" class="mt-2 rounded-lg max-h-40 hidden">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Extra Image 3</label>
        <input type="file" name="image_3" accept="image/*"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
               onchange="previewImage(event,'prev3')">
        <img id="prev3" class="mt-2 rounded-lg max-h-40 hidden">
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
                            <option value="shoes"       {{ old('type') == 'shoes'       ? 'selected' : '' }}>Shoes</option>
                            <option value="socks"       {{ old('type') == 'socks'       ? 'selected' : '' }}>Socks</option>
                            <option value="apparel"     {{ old('type') == 'apparel'     ? 'selected' : '' }}>Apparel</option>
                            <option value="accessories" {{ old('type') == 'accessories' ? 'selected' : '' }}>Accessories</option>
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
                            <option value="men"    {{ old('gender') == 'men'    ? 'selected' : '' }}>Men</option>
                            <option value="women"  {{ old('gender') == 'women'  ? 'selected' : '' }}>Women</option>
                            <option value="unisex" {{ old('gender') == 'unisex' ? 'selected' : '' }}>Unisex</option>
                        </select>
                    </div>

                    {{-- Category (dynamic) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select name="category" id="categorySelect" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Type & Gender First</option>
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
                    {{-- Dynamically populated by JS --}}
                </div>
            </div>

            {{-- Color Section --}}
            <div class="space-y-4">
    <h2 class="text-xl font-semibold text-gray-900 pb-2 border-b">Color Variants</h2>
    <p class="text-sm text-gray-500">Add up to 4 color options. Each can have its own image.</p>

    <div id="colorVariants" class="space-y-3">
        <div class="grid grid-cols-3 gap-3 p-4 border border-gray-200 rounded-lg">
            <div>
                <label class="text-xs font-medium text-gray-600">Color Name</label>
                <input type="text" name="variants[0][color_name]"
                       class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm"
                       placeholder="e.g. Natural White">
            </div>
            <div>
                <label class="text-xs font-medium text-gray-600">Color Code</label>
                <input type="color" name="variants[0][color_hex]" value="#000000"
                       class="w-full mt-1 h-10 border border-gray-300 rounded-lg cursor-pointer">
            </div>
            <div>
                <label class="text-xs font-medium text-gray-600">Color Image</label>
                <input type="file" name="variants[0][image]" accept="image/*"
                       class="w-full mt-1 text-sm">
            </div>
        </div>
    </div>

    <button type="button" onclick="addVariant()"
            class="text-sm text-blue-600 underline hover:text-blue-800">
        + Add Another Color (max 4)
    </button>
</div>

                    {{-- Color Hex --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Color Code</label>
                        <div class="flex gap-2">
                            <input type="color" name="color_hex" id="colorPicker" value="{{ old('color_hex', '#000000') }}"
                                   class="h-10 w-20 border border-gray-300 rounded-lg cursor-pointer">
                            <input type="text" id="colorHexText" value="{{ old('color_hex', '#000000') }}"
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
                            <input type="number" name="price" value="{{ old('price') }}" step="0.01" required
                                   class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0.00">
                        </div>
                    </div>

                    {{-- Sale Price --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sale Price (Optional)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-2 text-gray-500">$</span>
                            <input type="number" name="sale_price" value="{{ old('sale_price') }}" step="0.01"
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
                        <input type="checkbox" name="is_new" value="1" {{ old('is_new') ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm font-medium text-gray-700">Mark as New Arrival</span>
                    </label>

                    <label class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm font-medium text-gray-700">Featured Product</span>
                    </label>

                    <label class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="on_sale" value="1" {{ old('on_sale') ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm font-medium text-gray-700">On Sale</span>
                    </label>
                </div>
            </div>

            {{-- Submit Buttons --}}
            <div class="flex gap-4 pt-6 border-t">
                <button type="submit"
                        class="flex-1 bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-800 transition">
                    Add Product
                </button>
                <a href="{{ route('products.index') }}"
                   class="px-6 py-3 border border-gray-300 rounded-lg font-semibold hover:bg-gray-50 transition">
                    Cancel
                </a>
            </div>
        </form>

    </div>
</div>

<script>
    // ─── Category data ───────────────────────────────────────────────────────────
    const categoryData = {
        shoes: {
            men:    ['Sneakers', 'Slip-Ons', 'Slippers', 'All Weather', 'Sandals'],
            women:  ['Sneakers', 'Slip-Ons', 'Flats', 'Sandals', 'Slippers'],
            unisex: ['Sneakers', 'Slip-Ons', 'Sandals', 'Slippers', 'All Weather'],
        },
        socks: {
            men:    ['Ankle', 'Crew', 'No-Show', 'Knee High', 'Quarter'],
            women:  ['Ankle', 'Crew', 'No-Show', 'Knee High', 'Quarter'],
            unisex: ['Ankle', 'Crew', 'No-Show', 'Knee High'],
        },
        apparel: {
            men:    ['T-Shirts', 'Shorts', 'Jackets', 'Hoodies', 'Pants'],
            women:  ['T-Shirts', 'Leggings', 'Jackets', 'Hoodies', 'Shorts'],
            unisex: ['T-Shirts', 'Jackets', 'Hoodies'],
        },
        accessories: {
            men:    ['Hats', 'Bags', 'Insoles', 'Laces', 'Socks'],
            women:  ['Hats', 'Bags', 'Insoles', 'Laces'],
            unisex: ['Hats', 'Bags', 'Insoles', 'Laces'],
        },
    };

    // ─── Shoe sizes ───────────────────────────────────────────────────────────────
    const shoeSizes = {
        men:    ['7','7.5','8','8.5','9','9.5','10','10.5','11','11.5','12','13'],
        women:  ['5','5.5','6','6.5','7','7.5','8','8.5','9','9.5','10','11'],
        unisex: ['5','5.5','6','6.5','7','7.5','8','8.5','9','9.5','10','10.5','11','12'],
    };

    const oldCategory = "{{ old('category') }}";
    const oldGender   = "{{ old('gender') }}";
    const oldType     = "{{ old('type') }}";

    const typeSelect     = document.getElementById('typeSelect');
    const genderSelect   = document.getElementById('genderSelect');
    const categorySelect = document.getElementById('categorySelect');
    const sizesSection   = document.getElementById('sizesSection');
    const sizesGrid      = document.getElementById('sizesGrid');
    const categoryHint   = document.getElementById('categoryHint');

    function updateCategories() {
        const type   = typeSelect.value;
        const gender = genderSelect.value;

        categorySelect.innerHTML = '<option value="">Select Category</option>';

        if (type && gender && categoryData[type]?.[gender]) {
            categoryData[type][gender].forEach(cat => {
                const val = cat.toLowerCase().replace(/ /g, '-');
                const opt = document.createElement('option');
                opt.value       = val;
                opt.textContent = cat;
                if (oldCategory && val === oldCategory) opt.selected = true;
                categorySelect.appendChild(opt);
            });
            categoryHint.textContent = `${categoryData[type][gender].length} categories available`;
        } else {
            categoryHint.textContent = 'Choose a type and gender to see options';
        }

        updateSizes();
    }

    function updateSizes() {
        const type   = typeSelect.value;
        const gender = genderSelect.value;

        sizesGrid.innerHTML = '';

        if (type === 'shoes' && gender && shoeSizes[gender]) {
            sizesSection.classList.remove('hidden');
            shoeSizes[gender].forEach(size => {
                const div = document.createElement('div');
                div.className = 'flex flex-col items-center gap-1';
                div.innerHTML = `
                    <label class="text-xs font-semibold text-gray-600">US ${size}</label>
                    <input type="number" name="sizes[${size}]" min="0" value="0"
                           class="w-full text-center px-2 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                `;
                sizesGrid.appendChild(div);
            });
        } else {
            sizesSection.classList.add('hidden');
        }
    }

    typeSelect.addEventListener('change', updateCategories);
    genderSelect.addEventListener('change', updateCategories);

    // Color picker sync
    document.getElementById('colorPicker').addEventListener('input', function () {
        document.getElementById('colorHexText').value = this.value;
    });

    // Image preview
   function previewImage(event, previewId) {
    const preview = document.getElementById(previewId);
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

let variantCount = 1;
function addVariant() {
    if (variantCount >= 4) {
        alert('Maximum 4 color variants allowed.');
        return;
    }
    const container = document.getElementById('colorVariants');
    const div = document.createElement('div');
    div.className = 'grid grid-cols-3 gap-3 p-4 border border-gray-200 rounded-lg';
    div.innerHTML = `
        <div>
            <label class="text-xs font-medium text-gray-600">Color Name</label>
            <input type="text" name="variants[${variantCount}][color_name]"
                   class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm"
                   placeholder="e.g. Storm Blue">
        </div>
        <div>
            <label class="text-xs font-medium text-gray-600">Color Code</label>
            <input type="color" name="variants[${variantCount}][color_hex]" value="#000000"
                   class="w-full mt-1 h-10 border border-gray-300 rounded-lg cursor-pointer">
        </div>
        <div>
            <label class="text-xs font-medium text-gray-600">Color Image</label>
            <input type="file" name="variants[${variantCount}][image]" accept="image/*"
                   class="w-full mt-1 text-sm">
        </div>
    `;
    container.appendChild(div);
    variantCount++;
}

    // Restore old() values on validation error
    window.addEventListener('DOMContentLoaded', () => {
        if (oldType) {
            typeSelect.value = oldType;
            if (oldGender) {
                genderSelect.value = oldGender;
            }
            updateCategories();
        }
    });
</script>
@endsection