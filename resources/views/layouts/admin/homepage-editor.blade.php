@extends('layouts.admin.layout')
@section('title', 'Homepage Editor')

@section('content')

@if(session('success'))
<div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    {{-- ══════════════════════════════════════════════
         HERO SECTION
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Hero Section</h2>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Hero Image</label>
                @if(!empty($s['hero']['image']))
                    <img src="{{ asset($s['hero']['image']) }}" class="h-32 rounded-xl object-cover mb-2 border">
                @endif
                <input type="file" name="hero_image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                <p class="text-xs text-gray-400 mt-1">Leave blank to keep current image</p>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Italic Tagline</label>
                    <input type="text" name="hero_tagline" value="{{ $s['hero']['tagline'] ?? 'Made From Trees' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Main Heading</label>
                    <input type="text" name="hero_heading" value="{{ $s['hero']['heading'] ?? 'Wildly Comfortable. Super Natural.' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Collection Label</label>
                    <input type="text" name="hero_collection" value="{{ $s['hero']['collection'] ?? 'All New Dasher NZ Collection' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECTION 2 — 4 Cards
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Section 2 — Category Cards</h2>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach([
                ['key' => 's2_card_1', 'label' => 'Card 1 — New Arrivals'],
                ['key' => 's2_card_2', 'label' => 'Card 2 — Mens'],
                ['key' => 's2_card_3', 'label' => 'Card 3 — Womens'],
                ['key' => 's2_card_4', 'label' => 'Card 4 — Bestsellers'],
            ] as $card)
            <div class="border border-gray-200 rounded-xl p-4">
                <p class="text-xs font-semibold text-gray-500 mb-3 uppercase">{{ $card['label'] }}</p>
                @if(!empty($s[$card['key']]['image']))
                    <img src="{{ asset($s[$card['key']]['image']) }}" class="h-24 w-full object-cover rounded-lg mb-2 border">
                @endif
                <div class="space-y-3">
                    <div>
                        <label class="text-xs font-medium text-gray-600">Image</label>
                        <input type="file" name="{{ $card['key'] }}_image" accept="image/*"
                               class="w-full mt-1 text-xs border border-gray-300 rounded-lg px-2 py-1.5">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-600">Label Text</label>
                        <input type="text" name="{{ $card['key'] }}_label"
                               value="{{ $s[$card['key']]['label'] ?? '' }}"
                               class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm"
                               placeholder="e.g. New Arrivals">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-600">Button Link</label>
                        <input type="text" name="{{ $card['key'] }}_link"
                               value="{{ $s[$card['key']]['link'] ?? '' }}"
                               class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm"
                               placeholder="/men/shoes">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECTION 4 — 3-Grid Cards
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Section 4 — Collection Grid</h2>
        </div>
        <div class="p-6 space-y-4">
            {{-- Header --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border border-gray-200 rounded-xl p-4">
                <p class="text-xs font-semibold text-gray-500 uppercase md:col-span-3 mb-1">Header Text</p>
                <div>
                    <label class="text-xs font-medium text-gray-600">Product Name</label>
                    <input type="text" name="s4_header_name" value="{{ $s['s4_header']['name'] ?? 'Cruiser Slip On Canvas' }}"
                           class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600">Subtitle (color • price)</label>
                    <input type="text" name="s4_header_sub" value="{{ $s['s4_header']['sub'] ?? 'Blizzard (Blizzard Sole) • $90' }}"
                           class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
            </div>

            {{-- 3 cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                    ['key' => 's4_card_1', 'label' => 'Card 1'],
                    ['key' => 's4_card_2', 'label' => 'Card 2'],
                    ['key' => 's4_card_3', 'label' => 'Card 3'],
                ] as $card)
                <div class="border border-gray-200 rounded-xl p-4">
                    <p class="text-xs font-semibold text-gray-500 mb-3 uppercase">{{ $card['label'] }}</p>
                    @if(!empty($s[$card['key']]['image']))
                        <img src="{{ asset($s[$card['key']]['image']) }}" class="h-24 w-full object-cover rounded-lg mb-2 border">
                    @endif
                    <div class="space-y-3">
                        <div>
                            <label class="text-xs font-medium text-gray-600">Image</label>
                            <input type="file" name="{{ $card['key'] }}_image" accept="image/*"
                                   class="w-full mt-1 text-xs border border-gray-300 rounded-lg px-2 py-1.5">
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-600">Title</label>
                            <input type="text" name="{{ $card['key'] }}_title"
                                   value="{{ $s[$card['key']]['title'] ?? '' }}"
                                   class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-600">Men Button Link</label>
                            <input type="text" name="{{ $card['key'] }}_link_men"
                                   value="{{ $s[$card['key']]['link_men'] ?? '/men/shoes' }}"
                                   class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-600">Women Button Link</label>
                            <input type="text" name="{{ $card['key'] }}_link_women"
                                   value="{{ $s[$card['key']]['link_women'] ?? '/women/shoes' }}"
                                   class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         SECTION 6 — 3 Info Cards
    ══════════════════════════════════════════════ --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-widest">Section 6 — Info Cards</h2>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['key' => 's6_card_1', 'default_title' => 'Wear All Day Comfort',        'default_text' => 'Lightweight, bouncy, and wildly comfortable, Allbirds shoes make any outing feel effortless.'],
                ['key' => 's6_card_2', 'default_title' => 'Sustainability In Every Step', 'default_text' => "From materials to transport, we're working to reduce our carbon footprint to near zero."],
                ['key' => 's6_card_3', 'default_title' => 'Materials From The Earth',     'default_text' => 'We replace petroleum-based synthetics with natural alternatives like wool and tree fiber.'],
            ] as $card)
            <div class="border border-gray-200 rounded-xl p-4 space-y-3">
                <p class="text-xs font-semibold text-gray-500 uppercase">Card {{ $loop->iteration }}</p>
                <div>
                    <label class="text-xs font-medium text-gray-600">Title</label>
                    <input type="text" name="{{ $card['key'] }}_title"
                           value="{{ $s[$card['key']]['title'] ?? $card['default_title'] }}"
                           class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600">Text</label>
                    <textarea name="{{ $card['key'] }}_text" rows="3"
                              class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg text-sm">{{ $s[$card['key']]['text'] ?? $card['default_text'] }}</textarea>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Save button --}}
    <div class="flex justify-end">
        <button type="submit"
                class="bg-black text-white px-10 py-3 rounded-full font-bold text-sm hover:bg-gray-800 transition">
            Save All Changes
        </button>
    </div>

</form>

@endsection