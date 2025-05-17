@extends('layouts.mobile')

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}"></x-mobile.mobile-header>
    {{-- header --}}

    <div class="mt-4 mb-24" id="history-list">
        @foreach ($dataHistory as $item)
            <div class="mb-2">
                <x-mobile.history
                    id="{{ $item->id }}"
                    type="{{ $item->activity }}"
                    title="{{ $item->bookingClass?->title ?? $item->complaint?->title }}"
                    time="{{ $item->created_at }}"
                    status="{{ $item->bookingClass?->status ?? $item->complaint?->status }}"
                    description="{{ $item->bookingClass?->desc ?? $item->complaint?->desc }}"
                    class="{{ $item->book_id ? ($item->bookingClass?->class?->code ?? '') . '-' . ($item->bookingClass?->class?->name ?? '') : ($item->complaint?->class?->code ?? '') . '-' . ($item->complaint?->class?->name ?? '') }}"
                    {{-- @if($item->complaint_id)
                        image="{{ $item->complaint->photo }}"
                    @endif --}}
                ></x-mobile.history>
            </div>
        @endforeach
    </div>

    {{-- navbar --}}
    <div class="fixed bottom-0 w-full sm:w-[70%] md:w-[40%]">
        <x-mobile.mobile-navbar title="{{ $title }}"></x-mobile.mobile-navbar>
    </div>
@endsection