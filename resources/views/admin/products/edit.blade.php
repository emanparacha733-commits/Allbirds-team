@extends('layouts.admin')
@section('title', 'Edit Product')

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Product</h1>
            <p class="mt-1 text-sm text-gray-500">Update the details for <strong>{{ $product->name }}</strong></p>
        </div>
        <a href="{{ route('admin.products.index') }}"
           class="text-sm text-gray-500 hover:text-black border border-gray-200 px-4 py-2 rounded-lg hover:border-black transition">
            ← Back to Products
        </a>
    </div>

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

    {{-- Success --}}
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
          class="bg-white shadow-sm rounded-2xl p-8 space-y-6 border border-gray-100">
        @csrf
        @method('PUT')

        {{-- Basic Info --}}
        <div class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-900 pb-2 border-b">Basic Information</h2>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Product Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Main Image --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Main Image</label>
                <img src="{{ $product->image_url }}" class="w-32 h-32 object-cover rounded-xl border border-gray-200 mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-2">Replace Main Image (optional)</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                       onchange="previewImage(event, 'imagePreview')">
                <img id="imagePreview" class="mt-4 rounded-lg max-h-48 hidden" alt="Preview">
            </div>

            {{-- Image 2 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Image 2 (optional)</label>
                @if($product->image_2)
                    <img src="{{ asset('storage/' . $product->image_2) }}" class="w-32 h-32 object-cover rounded-xl border border-gray-200 mb-3">
                @endif
                <input type="file" name="image_2" accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                       onchange="previewImage(event, 'image2Preview')">
                <img id="image2Preview" class="mt-4 rounded-lg max-h-48 hidden" alt="Preview">
            </div>

            {{-- Image 3 --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Image 3 (optional)</label>
                @if($product->image_3)
                    <img src="{{ asset('storage/' . $product->image_3) }}" class="w-32 h-32 object-cover rounded-xl border border-gray-200 mb-3">
                @endif
                <input type="file" name="image_3" accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                       onchange="previewImage(event, 'image3Preview')">
                <img id="image3Preview" class="mt-4 rounded-lg max-h-48 hidden" alt="Preview">
            </div>
        </div>

        {{-- Category & Type --}}
        <div class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-900 pb-2 border-b">Category & Type</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type <span class="text-red-500">*</span></label>
                    <select name="type" id="typeSelect" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Type</option>
                        @foreach(['shoes','socks','apparel','accessories'] as $t)
                        <option value="{{ $t }}" {{ old('type', $product->type) == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gender <span class="text-red-500">*</span></label>
                    <select name="gender" id="genderSelect" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Gender</option>
                        @foreach(['men','women','unisex'] as $g)
                        <option value="{{ $g }}" {{ old('gender', $product->gender) == $g ? 'selected' : '' }}>{{ ucfirst($g) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                    <select name="category" id="categorySelect" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Category</option>
                    </select>
                    <p id="categoryHint" class="mt-1 text-xs text-gray-400">Choose type and gender to see options</p>
                </div>
            </div>
        </div>

        {{-- Sizes --}}
        <div id="sizesSection" class="space-y-4 hidden">
            <h2 class="text-lg font-semibold text-gray-900 pb-2 border-b">Sizes & Stock</h2>
            <div id="sizesGrid" class="grid grid-cols-4 sm:grid-cols-6 gap-3"></div>
        </div>

        {{-- Color --}}
        <div class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-900 pb-2 border-b">Main Color</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Color Name</label>
                    <input type="text" name="color_name" value="{{ old('color_name', $product->color_name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="e.g., Natural White">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Color Code</label>
                    <div class="flex gap-2">
                        <input type="color" name="color_hex" id="colorPicker" value="{{ old('color_hex', $product->color_hex ?? '#000000') }}"
                               class="h-10 w-20 border border-gray-300 rounded-lg cursor-pointer">
                        <input type="text" id="colorHexText" value="{{ old('color_hex', $product->color_hex ?? '#000000') }}"
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg" readonly>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════
             COLOR VARIANTS SECTION
        ════════════════════════════════════════ --}}
        <div class="space-y-6">
            <div class="flex items-center justify-between pb-2 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Color Variants</h2>
                <button type="button" onclick="addVariant()"
                        class="text-sm bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                    + Add Color Variant
                </button>
            </div>
            <p class="text-xs text-gray-400">Add different color versions of this product. Each variant needs a color name, hex code, and its own image.</p>

            <div id="variantsContainer" class="space-y-4">
                {{-- Existing variants --}}
                @php
                    $existingVariants = is_array($product->color_variants)
                        ? $product->color_variants
                        : (json_decode($product->color_variants, true) ?? []);
                @endphp

                @foreach($existingVariants as $i => $variant)
                <div class="variant-row border border-gray-200 rounded-xl p-4 bg-gray-50 relative" data-index="{{ $i }}">
                    <button type="button" onclick="removeVariant(this)"
                            class="absolute top-3 right-3 text-red-400 hover:text-red-600 text-lg font-bold">×</button>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Color Name</label>
                            <input type="text" name="variants[{{ $i }}][color_name]"
                                   value="{{ $variant['color_name'] ?? '' }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm"
                                   placeholder="e.g., Black">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Color Hex</label>
                            <div class="flex gap-2">
                                <input type="color" name="variants[{{ $i }}][color_hex]"
                                       value="{{ $variant['color_hex'] ?? '#000000' }}"
                                       class="h-9 w-16 border border-gray-300 rounded-lg cursor-pointer">
                                <input type="text" value="{{ $variant['color_hex'] ?? '#000000' }}"
                                       class="flex-1 px-2 py-2 border border-gray-300 rounded-lg text-sm" readonly>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Variant Image</label>
                            @if(!empty($variant['image']))
                                <img src="{{ asset('storage/' . $variant['image']) }}"
                                     class="w-16 h-16 object-contain rounded-lg border border-gray-200 mb-2 bg-gray-50">
                            @endif
                            <input type="file" name="variants[{{ $i }}][image]" accept="image/*"
                                   class="w-full text-sm border border-gray-300 rounded-lg px-2 py-1">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Pricing --}}
        <div class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-900 pb-2 border-b">Pricing</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Regular Price <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-2 text-gray-500">$</span>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" required
                               class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sale Price (Optional)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-2 text-gray-500">$</span>
                        <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" step="0.01"
                               class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </div>

        {{-- Flags --}}
        <div class="space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 pb-2 border-b">Product Flags</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <label class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="checkbox" name="is_new" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded">
                    <span class="text-sm font-medium text-gray-700">New Arrival</span>
                </label>
                <label class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Featured</span>
                </label>
                <label class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="checkbox" name="on_sale" value="1" {{ old('on_sale', $product->on_sale) ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded">
                    <span class="text-sm font-medium text-gray-700">On Sale</span>
                </label>
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex gap-4 pt-6 border-t">
            <button type="submit"
                    class="flex-1 bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-800 transition">
                Save Changes
            </button>
            <a href="{{ route('admin.products.index') }}"
               class="px-6 py-3 border border-gray-300 rounded-lg font-semibold hover:bg-gray-50 transition">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
const categoryData = {
    shoes:       { men: ['Sneakers','Slip-Ons','Slippers','All Weather','Sandals'], women: ['Sneakers','Slip-Ons','Flats','Sandals','Slippers'], unisex: ['Sneakers','Slip-Ons','Sandals','Slippers','All Weather'] },
    socks:       { men: ['Ankle','Crew','No-Show','Knee High','Quarter'], women: ['Ankle','Crew','No-Show','Knee High','Quarter'], unisex: ['Ankle','Crew','No-Show','Knee High'] },
    apparel:     { men: ['T-Shirts','Shorts','Jackets','Hoodies','Pants'], women: ['T-Shirts','Leggings','Jackets','Hoodies','Shorts'], unisex: ['T-Shirts','Jackets','Hoodies'] },
    accessories: { men: ['Hats','Bags','Insoles','Laces','Socks'], women: ['Hats','Bags','Insoles','Laces'], unisex: ['Hats','Bags','Insoles','Laces'] },
};

const shoeSizes = {
    men:    ['7','7.5','8','8.5','9','9.5','10','10.5','11','11.5','12','13'],
    women:  ['5','5.5','6','6.5','7','7.5','8','8.5','9','9.5','10','11'],
    unisex: ['5','5.5','6','6.5','7','7.5','8','8.5','9','9.5','10','10.5','11','12'],
};

const currentCategory = "{{ old('category', $product->category) }}";
const currentSizes    = @json($product->sizes ?? []);

const typeSelect   = document.getElementById('typeSelect');
const genderSelect = document.getElementById('genderSelect');
const categorySelect = document.getElementById('categorySelect');
const sizesSection = document.getElementById('sizesSection');
const sizesGrid    = document.getElementById('sizesGrid');
const categoryHint = document.getElementById('categoryHint');

function updateCategories() {
    const type   = typeSelect.value;
    const gender = genderSelect.value;
    categorySelect.innerHTML = '<option value="">Select Category</option>';
    if (type && gender && categoryData[type]?.[gender]) {
        categoryData[type][gender].forEach(cat => {
            const val = cat.toLowerCase().replace(/ /g, '-');
            const opt = document.createElement('option');
            opt.value = val; opt.textContent = cat;
            if (val === currentCategory) opt.selected = true;
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
            const existing = currentSizes[size] ?? 0;
            const div = document.createElement('div');
            div.className = 'flex flex-col items-center gap-1';
            div.innerHTML = `
                <label class="text-xs font-semibold text-gray-600">US ${size}</label>
                <input type="number" name="sizes[${size}]" min="0" value="${existing}"
                       class="w-full text-center px-2 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
            `;
            sizesGrid.appendChild(div);
        });
    } else {
        sizesSection.classList.add('hidden');
    }
}

typeSelect.addEventListener('change', updateCategories);
genderSelect.addEventListener('change', updateCategories);

document.getElementById('colorPicker').addEventListener('input', function () {
    document.getElementById('colorHexText').value = this.value;
});

function previewImage(event, previewId) {
    const preview = document.getElementById(previewId);
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.classList.remove('hidden'); };
        reader.readAsDataURL(file);
    }
}

// ── Color Variants ──────────────────────────────────────
let variantIndex = {{ count($existingVariants ?? []) }};

function addVariant() {
    const container = document.getElementById('variantsContainer');
    const div = document.createElement('div');
    div.className = 'variant-row border border-gray-200 rounded-xl p-4 bg-gray-50 relative';
    div.dataset.index = variantIndex;
    div.innerHTML = `
        <button type="button" onclick="removeVariant(this)"
                class="absolute top-3 right-3 text-red-400 hover:text-red-600 text-lg font-bold">×</button>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Color Name</label>
                <input type="text" name="variants[${variantIndex}][color_name]"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm"
                       placeholder="e.g., Black">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Color Hex</label>
                <div class="flex gap-2">
                    <input type="color" name="variants[${variantIndex}][color_hex]"
                           value="#000000"
                           class="h-9 w-16 border border-gray-300 rounded-lg cursor-pointer variant-color-picker">
                    <input type="text" value="#000000"
                           class="flex-1 px-2 py-2 border border-gray-300 rounded-lg text-sm variant-color-text" readonly>
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Variant Image</label>
                <input type="file" name="variants[${variantIndex}][image]" accept="image/*"
                       class="w-full text-sm border border-gray-300 rounded-lg px-2 py-1">
            </div>
        </div>
    `;
    container.appendChild(div);

    // Sync color picker
    const picker = div.querySelector('.variant-color-picker');
    const text   = div.querySelector('.variant-color-text');
    picker.addEventListener('input', () => { text.value = picker.value; });

    variantIndex++;
}

function removeVariant(btn) {
    btn.closest('.variant-row').remove();
}

// Sync existing variant color pickers
document.querySelectorAll('.variant-row').forEach(row => {
    const picker = row.querySelector('input[type="color"]');
    const text   = row.querySelector('input[readonly]');
    if (picker && text) {
        picker.addEventListener('input', () => { text.value = picker.value; });
    }
});

window.addEventListener('DOMContentLoaded', () => { updateCategories(); });
</script>
@endsection