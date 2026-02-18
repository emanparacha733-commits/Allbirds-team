@extends('admin.layout')

@section('content')

<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
    <div class="grid grid-cols-12 gap-4 md:gap-6">

        <div class="col-span-12 space-y-6 xl:col-span-7">

            {{-- Metric Group One --}}
            @include('admin.partials.metric-group-01')

            {{-- Chart One --}}
            @include('admin.partials.chart-01')

        </div>

        <div class="col-span-12 xl:col-span-5">
            {{-- Chart Two --}}
            @include('admin.partials.chart-02')
        </div>

        <div class="col-span-12">
            {{-- Chart Three --}}
            @include('admin.partials.chart-03')
        </div>

        <div class="col-span-12 xl:col-span-5">
            {{-- Map --}}
            @include('admin.partials.map-01')
        </div>

        <div class="col-span-12 xl:col-span-7">
            {{-- Table --}}
            @include('admin.partials.table-01')
        </div>

    </div>
</div>

@endsection
