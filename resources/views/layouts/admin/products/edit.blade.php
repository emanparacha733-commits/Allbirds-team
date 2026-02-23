@extends('layouts.admin.layout')
@section('title', 'Edit Product')

@php
    $colorVariants = $product->color_variants;
    if (is_string($colorVariants)) {
        $colorVariants = json_decode($colorVariants, true) ?? [];
    }
    if (!is_array($colorVariants)) {
        $colorVariants = [];
    }
@endphp

@section('content')
<div class="max-w-3xl mx-auto">

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

    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
          class="bg-white shadow-sm rounded-2xl p-8 space-y-6 border border-gray-100">
        @csrf
        @method('PUT')

        {{-- ── Basic Info ── --}}
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

            {{-- Default fallback images --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Default Image 1</label>
                    @if($product->image)
                        <img src="{{ $product->image_url }}" class="w-24 h-24 object-cover rounded-lg border mb-2">
                    @endif
                    <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" onchange="previewImage(event,'prevMain')">
                    <img id="prevMain" class="mt-2 rounded-lg max-h-32 hidden">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Default Image 2</label>
                    @if($product->image_2)
                        <img src="{{ asset('storage/' . $product->image_2) }}" class="w-24 h-24 object-cover rounded-lg border mb-2">
                    @endif
                    <input type="file" name="image_2" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" onchange="previewImage(event,'prev2')">
                    <img id="prev2" class="mt-2 rounded-lg max-h-32 hidden">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Default Image 3</label>
                    @if($product->image_3)
                        <img src="{{ asset('storage/' . $product->image_3) }}" class="w-24 h-24 object-cover rounded-lg border mb-2">
                    @endif
                    <input type="file" name="image_3" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" onchange="previewImage(event,'prev3')">
                    <img id="prev3" class="mt-2 rounded-lg max-h-32 hidden">
                </div>
            </div>
        </div>

        {{-- ── Category & Type ── --}}
        <div class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-900 pb-2 border-b">Category & Type</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type <span class="text-red-500">*</span></label>
                    <select name="type" id="typeSelect" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Type</option>
                        @foreach(['shoes','socks','apparel','accessories'] as $t)
                        <option value="{{ $t }}" {{ old('type', $product->type) == $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gender <span class="text-red-500">*</span></label>
                    <select name="gender" id="genderSelect" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Gender</option>
                        @foreach(['men','women','unisex'] as $g)
                        <option value="{{ $g }}" {{ old('gender', $product->gender) == $g ? 'selected' : '' }}>{{ ucfirst($g) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                    <select name="category" id="categorySelect" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Category</option>
                    </select>
                    <p id="categoryHint" class="mt-1 text-xs text-gray-400">Choose type and gender first</p>
                </div>
            </div>
        </div>

        {{-- ── Sizes ── --}}
        <div id="sizesSection" class="space-y-4 hidden">
            <h2 class="text-lg font-semibold text-gray-900 pb-2 border-b">Sizes & Stock</h2>
            <div id="sizesGrid" class="grid grid-cols-4 sm:grid-cols-6 gap-3"></div>
        </div>

        {{-- ── Color Variants — 2 images each ── --}}
        <div class="space-y-4">
            <h2 class="text-lg font-semibold text-gray-900 pb-2 border-b">Color Variants</h2>
            <p class="text-sm text-gray-500">Each color has 2 image slots (main + side view). Leave blank to keep existing images.</p>

            <div id="colorVariants" class="space-y-4">
                @if(!empty($colorVariants))
                    @foreach($colorVariants as $i => $variant)
                    <div class="variant-row border border-gray-200 rounded-xl p-4 relative" data-index="{{ $i }}">
                        <p class="text-xs font-semibold text-gray-500 mb-3">VARIANT {{ $i + 1 }}</p>

                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div>
                                <label class="text-xs font-medium text-gray-600">Color Name</label>
                                <input type="text" name="variants[{{ $i }}][color_name]"
                                       value="{{ $variant['color_name'] ?? '' }}"
                                       class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm"
                                       placeholder="e.g. Jet Black">
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-600">Color Code</label>
                                <input type="color" name="variants[{{ $i }}][color_hex]"
                                       value="{{ $variant['color_hex'] ?? '#000000' }}"
                                       class="w-full mt-1 h-10 border border-gray-300 rounded-lg cursor-pointer">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            {{-- Image 1 --}}
                            <div>
                                <label class="text-xs font-medium text-gray-600">Image 1 — Main View</label>
                                @if(!empty($variant['image']))
                                    <img id="variantPreview_{{ $i }}_1"
                                         src="{{ asset('storage/' . $variant['image']) }}"
                                         class="mt-1 h-28 w-full object-cover rounded-lg border border-gray-200 mb-2">
                                @else
                                    <img id="variantPreview_{{ $i }}_1"
                                         class="mt-1 h-28 w-full object-cover rounded-lg border border-gray-200 mb-2 hidden">
                                @endif
                                <input type="file" name="variants[{{ $i }}][image]" accept="image/*"
                                       class="w-full text-xs" onchange="previewVariantImage(event,{{ $i }},1)">
                                <input type="hidden" name="variants[{{ $i }}][existing_image]" value="{{ $variant['image'] ?? '' }}">
                            </div>

                            {{-- Image 2 --}}
                            <div>
                                <label class="text-xs font-medium text-gray-600">Image 2 — Side View</label>
                                @if(!empty($variant['image_2']))
                                    <img id="variantPreview_{{ $i }}_2"
                                         src="{{ asset('storage/' . $variant['image_2']) }}"
                                         class="mt-1 h-28 w-full object-cover rounded-lg border border-gray-200 mb-2">
                                @else
                                    <img id="variantPreview_{{ $i }}_2"
                                         class="mt-1 h-28 w-full object-cover rounded-lg border border-gray-200 mb-2 hidden">
                                @endif
                                <input type="file" name="variants[{{ $i }}][image_2]" accept="image/*"
                                       class="w-full text-xs" onchange="previewVariantImage(event,{{ $i }},2)">
                                <input type="hidden" name="variants[{{ $i }}][existing_image_2]" value="{{ $variant['image_2'] ?? '' }}">
                            </div>
                        </div>

                        @if($i > 0)
                        <button type="button" onclick="removeVariant(this)"
                                class="absolute top-3 right-3 text-red-400 hover:text-red-600 text-xs font-medium">✕ Remove</button>
                        @endif
                    </div>
                    @endforeach
                @else
                    <div class="variant-row border border-gray-200 rounded-xl p-4 relative" data-index="0">
                        <p class="text-xs font-semibold text-gray-500 mb-3">VARIANT 1</p>
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div>
                                <label class="text-xs font-medium text-gray-600">Color Name</label>
                                <input type="text" name="variants[0][color_name]" value="{{ $product->color_name ?? '' }}"
                                       class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm" placeholder="e.g. Natural White">
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-600">Color Code</label>
                                <input type="color" name="variants[0][color_hex]" value="{{ $product->color_hex ?? '#000000' }}"
                                       class="w-full mt-1 h-10 border border-gray-300 rounded-lg cursor-pointer">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-medium text-gray-600">Image 1 — Main View</label>
                                <img id="variantPreview_0_1" class="mt-1 h-28 w-full object-cover rounded-lg border border-gray-200 mb-2 hidden">
                                <input type="file" name="variants[0][image]" accept="image/*" class="w-full text-xs" onchange="previewVariantImage(event,0,1)">
                                <input type="hidden" name="variants[0][existing_image]" value="">
                            </div>
                            <div>
                                <label class="text-xs font-medium text-gray-600">Image 2 — Side View</label>
                                <img id="variantPreview_0_2" class="mt-1 h-28 w-full object-cover rounded-lg border border-gray-200 mb-2 hidden">
                                <input type="file" name="variants[0][image_2]" accept="image/*" class="w-full text-xs" onchange="previewVariantImage(event,0,2)">
                                <input type="hidden" name="variants[0][existing_image_2]" value="">
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <button type="button" onclick="addVariant()"
                    class="text-sm text-blue-600 underline hover:text-blue-800">+ Add Another Color (max 4)</button>
        </div>

        {{-- ── Pricing ── --}}
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

        {{-- ── Flags ── --}}
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

        <div class="flex gap-4 pt-6 border-t">
            <button type="submit" class="flex-1 bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-800 transition">
                Save Changes
            </button>
            <a href="{{ route('admin.products.index') }}"
               class="px-6 py-3 border border-gray-300 rounded-lg font-semibold hover:bg-gray-50 transition">Cancel</a>
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
const shoeSizes  = { men: ['7','7.5','8','8.5','9','9.5','10','10.5','11','11.5','12','13'], women: ['5','5.5','6','6.5','7','7.5','8','8.5','9','9.5','10','11'], unisex: ['5','5.5','6','6.5','7','7.5','8','8.5','9','9.5','10','10.5','11','12'] };
const sockSizes  = ['XS','S','M','L','XL','XXL'];
const currentCategory = "{{ old('category', $product->category) }}";
const currentSizes    = @json($product->sizes ?? []);

const typeSelect     = document.getElementById('typeSelect');
const genderSelect   = document.getElementById('genderSelect');
const categorySelect = document.getElementById('categorySelect');
const sizesSection   = document.getElementById('sizesSection');
const sizesGrid      = document.getElementById('sizesGrid');
const categoryHint   = document.getElementById('categoryHint');

function updateCategories() {
    const type = typeSelect.value, gender = genderSelect.value;
    categorySelect.innerHTML = '<option value="">Select Category</option>';
    if (type && gender && categoryData[type]?.[gender]) {
        categoryData[type][gender].forEach(cat => {
            const val = cat.toLowerCase().replace(/ /g,'-');
            const opt = document.createElement('option');
            opt.value = val; opt.textContent = cat;
            if (val === currentCategory) opt.selected = true;
            categorySelect.appendChild(opt);
        });
        categoryHint.textContent = `${categoryData[type][gender].length} categories available`;
    } else {
        categoryHint.textContent = 'Choose type and gender first';
    }
    updateSizes();
}

function updateSizes() {
    const type = typeSelect.value, gender = genderSelect.value;
    sizesGrid.innerHTML = '';
    if (type === 'shoes' && gender && shoeSizes[gender]) {
        sizesSection.classList.remove('hidden');
        shoeSizes[gender].forEach(s => sizesGrid.appendChild(makeSizeInput(`US ${s}`, s, currentSizes[s] ?? 0)));
    } else if (type === 'socks' || type === 'apparel') {
        sizesSection.classList.remove('hidden');
        sockSizes.forEach(s => sizesGrid.appendChild(makeSizeInput(s, s, currentSizes[s] ?? 0)));
    } else {
        sizesSection.classList.add('hidden');
    }
}

function makeSizeInput(label, name, val) {
    const d = document.createElement('div');
    d.className = 'flex flex-col items-center gap-1';
    d.innerHTML = `<label class="text-xs font-semibold text-gray-600">${label}</label>
        <input type="number" name="sizes[${name}]" min="0" value="${val}"
               class="w-full text-center px-2 py-1.5 border border-gray-300 rounded-lg text-sm">`;
    return d;
}

typeSelect.addEventListener('change', updateCategories);
genderSelect.addEventListener('change', updateCategories);

function previewImage(event, id) {
    const el = document.getElementById(id), file = event.target.files[0];
    if (!file) return;
    const r = new FileReader();
    r.onload = e => { el.src = e.target.result; el.classList.remove('hidden'); };
    r.readAsDataURL(file);
}

function previewVariantImage(event, index, slot) {
    const el = document.getElementById(`variantPreview_${index}_${slot}`);
    if (!el) return;
    const file = event.target.files[0];
    if (!file) return;
    const r = new FileReader();
    r.onload = e => { el.src = e.target.result; el.classList.remove('hidden'); };
    r.readAsDataURL(file);
}

function addVariant() {
    const rows = document.querySelectorAll('.variant-row');
    if (rows.length >= 4) { alert('Maximum 4 color variants allowed.'); return; }
    const idx = rows.length;
    const container = document.getElementById('colorVariants');
    const div = document.createElement('div');
    div.className = 'variant-row border border-gray-200 rounded-xl p-4 relative';
    div.dataset.index = idx;
    div.innerHTML = `
        <p class="text-xs font-semibold text-gray-500 mb-3">VARIANT ${idx + 1}</p>
        <div class="grid grid-cols-2 gap-3 mb-4">
            <div>
                <label class="text-xs font-medium text-gray-600">Color Name</label>
                <input type="text" name="variants[${idx}][color_name]"
                       class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm" placeholder="e.g. Storm Blue">
            </div>
            <div>
                <label class="text-xs font-medium text-gray-600">Color Code</label>
                <input type="color" name="variants[${idx}][color_hex]" value="#000000"
                       class="w-full mt-1 h-10 border border-gray-300 rounded-lg cursor-pointer">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-xs font-medium text-gray-600">Image 1 — Main View</label>
                <img id="variantPreview_${idx}_1" class="mt-1 h-28 w-full object-cover rounded-lg border border-gray-200 mb-2 hidden">
                <input type="file" name="variants[${idx}][image]" accept="image/*"
                       class="w-full text-xs" onchange="previewVariantImage(event,${idx},1)">
                <input type="hidden" name="variants[${idx}][existing_image]" value="">
            </div>
            <div>
                <label class="text-xs font-medium text-gray-600">Image 2 — Side View</label>
                <img id="variantPreview_${idx}_2" class="mt-1 h-28 w-full object-cover rounded-lg border border-gray-200 mb-2 hidden">
                <input type="file" name="variants[${idx}][image_2]" accept="image/*"
                       class="w-full text-xs" onchange="previewVariantImage(event,${idx},2)">
                <input type="hidden" name="variants[${idx}][existing_image_2]" value="">
            </div>
        </div>
        <button type="button" onclick="removeVariant(this)"
                class="absolute top-3 right-3 text-red-400 hover:text-red-600 text-xs font-medium">✕ Remove</button>`;
    container.appendChild(div);
}

function removeVariant(btn) {
    btn.closest('.variant-row').remove();
    document.querySelectorAll('.variant-row').forEach((row, i) => {
        row.dataset.index = i;
        row.querySelector('p').textContent = `VARIANT ${i + 1}`;
        row.querySelectorAll('[name]').forEach(el => {
            el.name = el.name.replace(/variants\[\d+\]/, `variants[${i}]`);
        });
        row.querySelectorAll('[id^="variantPreview_"]').forEach(img => {
            const slot = img.id.split('_').pop();
            img.id = `variantPreview_${i}_${slot}`;
        });
        row.querySelectorAll('input[type="file"]').forEach((f, fi) => {
            f.setAttribute('onchange', `previewVariantImage(event,${i},${fi + 1})`);
        });
        const removeBtn = row.querySelector('button[onclick^="removeVariant"]');
        if (removeBtn) removeBtn.style.display = i === 0 ? 'none' : '';
    });
}

window.addEventListener('DOMContentLoaded', updateCategories);
</script>
@endsection