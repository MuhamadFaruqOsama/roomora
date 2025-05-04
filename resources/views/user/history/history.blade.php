@extends('layouts.mobile')

@php
    $dataHistory = [
        [
            'title' => 'Booking Ruangan Untuk Ujian',
            'status' => 'pending',
            'time' => '2025-05-01 08:00',
            'class' => 'E11-404',
            'type' => 'booking',
            'image' => 'room-1.jpg',
            'description' => 'Memesan ruangan untuk keperluan ujian tengah semester.',
        ],
        [
            'title' => 'AC Tidak Dingin',
            'status' => 'finished',
            'time' => '2025-04-30 14:30',
            'class' => 'E11-405',
            'type' => 'complaint',
            'image' => 'room-1.jpg',
            'description' => 'AC tidak dingin sejak kemarin, mohon segera dicek.',
        ],
        [
            'title' => 'Booking Ruangan Presentasi',
            'status' => 'rejected',
            'time' => '2025-04-29 13:00',
            'class' => 'E12-401',
            'type' => 'booking',
            'image' => 'room-1.jpg',
            'description' => 'Dibutuhkan ruangan untuk kegiatan presentasi kelompok.',
        ],
        [
            'title' => 'Lampu Mati',
            'status' => 'pending',
            'time' => '2025-05-02 09:15',
            'class' => 'E12-402',
            'type' => 'complaint',
            'image' => 'room-1.jpg',
            'description' => 'Beberapa lampu tidak menyala sejak dua hari lalu.',
        ],
        [
            'title' => 'Booking Lab Komputer',
            'status' => 'finished',
            'time' => '2025-04-28 11:30',
            'class' => 'E13-403',
            'type' => 'booking',
            'image' => 'room-1.jpg',
            'description' => 'Penggunaan lab komputer untuk pelatihan software.',
        ],
        [
            'title' => 'Kursi Rusak',
            'status' => 'rejected',
            'time' => '2025-04-27 10:00',
            'class' => 'E13-404',
            'type' => 'complaint',
            'image' => 'room-1.jpg',
            'description' => 'Beberapa kursi dalam kelas sudah tidak bisa dipakai.',
        ],
        [
            'title' => 'Booking Ruangan Seminar',
            'status' => 'pending',
            'time' => '2025-05-03 13:30',
            'class' => 'E14-401',
            'type' => 'booking',
            'image' => 'room-1.jpg',
            'description' => 'Akan digunakan untuk seminar mahasiswa.',
        ],
        [
            'title' => 'Whiteboard Tidak Bisa Dihapus',
            'status' => 'finished',
            'time' => '2025-04-26 16:45',
            'class' => 'E14-402',
            'type' => 'complaint',
            'image' => 'room-1.jpg',
            'description' => 'Whiteboard tidak bisa dihapus walaupun sudah pakai penghapus.',
        ],
        [
            'title' => 'Booking Kelas Tambahan',
            'status' => 'rejected',
            'time' => '2025-04-25 15:00',
            'class' => 'E15-401',
            'type' => 'booking',
            'image' => 'room-1.jpg',
            'description' => 'Kelas tambahan untuk pengganti kelas yang tertunda.',
        ],
        [
            'title' => 'Saklar Lampu Rusak',
            'status' => 'pending',
            'time' => '2025-05-01 10:20',
            'class' => 'E15-402',
            'type' => 'complaint',
            'image' => 'room-1.jpg',
            'description' => 'Saklar tidak bisa ditekan dan lampu tidak menyala.',
        ],
    ];
@endphp

@section('mobile-main-content')
    {{-- header --}}
    <x-mobile.mobile-header title="{{ $title }}"></x-mobile.mobile-header>
    {{-- header --}}

    <div class="mt-4 mb-24 px-5" id="history-list">
        @foreach ($dataHistory as $item)
            <div class="mb-2">
                <x-mobile.history
                    type="{{ $item['type'] }}"
                    title="{{ $item['title'] }}"
                    time="{{ $item['time'] }}"
                    status="{{ $item['status'] }}"
                    description="{{ $item['description'] }}"
                    image="{{ $item['image'] }}"
                    class="{{ $item['class'] }}"
                ></x-mobile.history>
            </div>
        @endforeach
    </div>

    {{-- navbar --}}
    <div class="fixed bottom-0 w-full sm:w-[70%] md:w-[40%]">
        <x-mobile.mobile-navbar title="{{ $title }}"></x-mobile.mobile-navbar>
    </div>
@endsection