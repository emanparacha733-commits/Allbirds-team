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
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Product Image <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="image" accept="image/*" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           onchange="previewImage(event)">
                    <img id="imagePreview" class="mt-4 rounded-lg max-h-48 hidden" alt="Preview">
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
                        <select name="type" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Type</option>
                            <option value="shoes" {{ old('type') == 'shoes' ? 'selected' : '' }}>Shoes</option>
                            <option value="socks" {{ old('type') == 'socks' ? 'selected' : '' }}>Socks</option>
                            <option value="apparel" {{ old('type') == 'apparel' ? 'selected' : '' }}>Apparel</option>
                            <option value="accessories" {{ old('type') == 'accessories' ? 'selected' : '' }}>Accessories</option>
                        </select>
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="category" value="{{ old('category') }}" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="e.g., ankle, crew, no-show">
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Gender <span class="text-red-500">*</span>
                        </label>
                        <select name="gender" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Gender</option>
                            <option value="men" {{ old('gender') == 'men' ? 'selected' : '' }}>Men</option>
                            <option value="women" {{ old('gender') == 'women' ? 'selected' : '' }}>Women</option>
                            <option value="unisex" {{ old('gender') == 'unisex' ? 'selected' : '' }}>Unisex</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Color Section --}}
            <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 pb-2 border-b">Color Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Color Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Color Name</label>
                        <input type="text" name="color_name" value="{{ old('color_name') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="e.g., Natural White">
                    </div>

                    {{-- Color Hex --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Color Code</label>
                        <div class="flex gap-2">
                            <input type="color" name="color_hex" value="{{ old('color_hex', '#000000') }}"
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
                    {{-- Is New --}}
                    <label class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="is_new" value="1" {{ old('is_new') ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm font-medium text-gray-700">Mark as New Arrival</span>
                    </label>

                    {{-- Is Featured --}}
                    <label class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm font-medium text-gray-700">Featured Product</span>
                    </label>

                    {{-- On Sale --}}
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

{{-- JavaScript for Image Preview and Color Sync --}}
<script>
    // Image preview
    function previewImage(event) {
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    // Sync color picker with hex input
    document.querySelector('input[name="color_hex"]').addEventListener('input', function(e) {
        document.getElementById('colorHexText').value = e.target.value;
    });
</script>
@endsection