@php
    $navItems = [
        [
            'title' => 'Dashboard', 
            'icon' => 'hgi hgi-stroke hgi-home-09', 
            'route' => '/app/dashboard'
        ],
        [
            'title' => 'Class', 
            'icon' => 'hgi hgi-stroke hgi-building-03', 
            'route' => '/app/class'
        ],
        [
            'title' => 'Complaint', 
            'icon' => 'hgi hgi-stroke hgi-customer-service-01', 
            'route' => '/app/complaint'
        ],
        [
            'title' => 'History', 
            'icon' => 'hgi hgi-stroke hgi-clock-04', 
            'route' => '/app/history'
        ],
        [
            'title' => 'Profile', 
            'icon' => 'hgi hgi-stroke hgi-user', 
            'route' => '/app/profile', 
        ],
    ];
@endphp

<div class="w-full bg-white px-5 py-3 border-t border-gray-300 shadow-sm relative">
    <div class="flex justify-between items-center gap-1 md:gap-3">
        @foreach ($navItems as $item)
            <a href="{{ $item['route'] }}">
                <div class="flex gap-2 {{ $title == $item['title'] ? 'bg-[#24316F] backdrop-opacity-20 bg-opacity-20 py-3 px-4 rounded-full' : '' }} justify-center items-center text-center">
                    <i class="text-lg {{ $item['icon'] }} {{ $title == $item['title'] ? 'text-white' : 'text-gray-700' }}"></i>
                    @if ($title == $item['title'])
                        <div class="text-xs line-clamp-1 transition-all duration-300 text-white font-semibold">{{ $item['title'] }}</div>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
</div>
