@php
    use Carbon\Carbon;

    $scheduleData = json_decode(html_entity_decode($scheduleData));

    $startHour = 7;
    $endHour = 18;
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    $occupied = [];
    $scheduleByTime = [];

    $today = Carbon::today();
    $nextWeek = Carbon::today()->addDays(7);

    foreach ($scheduleData as $item) {
        $startDate = Carbon::parse($item->created_at);
        if ($item->type === "book" && $startDate->between($today, $nextWeek)) {
            $startHourItem = Carbon::parse($item->start)->hour;
            $endHourItem = Carbon::parse($item->end)->hour;
            $duration = $endHourItem - $startHourItem;

            for ($h = $startHourItem; $h < $endHourItem; $h++) {
                $occupied[$item->day][$h] = true;
            }

            // Hanya isi data di jam awal
            $scheduleByTime[$item->day][$startHourItem] = [
                'subject' => $item->subject,
                'duration' => $duration,
                'type' => $item->type,
            ];
        } else {
            $startHourItem = Carbon::parse($item->start)->hour;
            $endHourItem = Carbon::parse($item->end)->hour;
            $duration = $endHourItem - $startHourItem;

            for ($h = $startHourItem; $h < $endHourItem; $h++) {
                $occupied[$item->day][$h] = true;
            }

            // Hanya isi data di jam awal
            $scheduleByTime[$item->day][$startHourItem] = [
                'subject' => $item->subject,
                'duration' => $duration,
                'type' => $item->type,
            ];
        }
    }
@endphp

<table class="min-w-full border border-[#5aa9e6] text-sm text-left">
    <thead class="bg-blue-100">
        <tr>
            <th class="border border-[#5aa9e6] bg-[#7fc8f8] text-white px-4 py-2">Time</th>
            @foreach ($days as $day)
                <th class="border border-[#5aa9e6] bg-[#7fc8f8] text-white px-4 py-2">{{ $day }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @for ($hour = $startHour; $hour < $endHour; $hour++)
            <tr>
                <td class="border border-[#5aa9e6] px-4 py-2">{{ $hour }}:00</td>
                @foreach ($days as $day)
                    @php
                        $schedule = $scheduleByTime[$day][$hour] ?? null;
                    @endphp

                    @if ($schedule)
                        <td class="border border-[#5aa9e6] px-4 py-2 text-sm {{ $schedule['type'] === 'main' ? 'bg-green-50' : 'bg-red-50' }}"
                            rowspan="{{ $schedule['duration'] }}">
                            {{ $schedule['subject'] }}
                            @if ($schedule['type'] === 'book')
                                <span class="text-gray-300 text-xs">(booked)</span>
                            @endif
                        </td>
                    @elseif (!empty($occupied[$day][$hour]))
                        {{-- Kolom ini ditutup oleh rowspan --}} 
                    @else
                        <td class="border border-[#5aa9e6] px-4 py-2 cursor-pointer"
                            @if ($isProfileDataFilled)
                                data-modal-target="booking-class-modal{{ $modalKey ? '-' . $modalKey : '' }}"
                                data-modal-toggle="booking-class-modal{{ $modalKey ? '-' . $modalKey : '' }}"
                                title="Tap to Book this class"
                                id="booking-class-form-{{ $classId }}"
                                data-time-start="{{ $hour }}"
                                @php
                                    $nextOccupiedHour = null;
                                    for ($h = $hour + 1; $h <= $endHour; $h++) {
                                        if (!empty($scheduleByTime[$day][$h])) {
                                            $nextOccupiedHour = $h;
                                            break;
                                        }
                                    }
                                    $timeEnd = $nextOccupiedHour ?? $endHour;
                                @endphp
                                data-time-end="{{ $timeEnd }}"
                                data-class-name="{{ $className }}"
                                data-date="{{ $day }}"
                            @else
                                onclick="getNotification('Please fill your profile data first before booking the class', false)"
                            @endif
                        ></td>
                    @endif
                @endforeach
            </tr>
        @endfor
    </tbody>
</table>


<!-- Extra Large Modal -->
<div id="booking-class-modal{{ $modalKey != null ? '-' . $modalKey : '' }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-[99999999] hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-auto">
    <div class="relative w-full max-w-7xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm h-auto">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                <h3 class="font-medium text-gray-900">Form Booking Class</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="booking-class-modal{{ $modalKey != null ? '-' . $modalKey : '' }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body (scrollable) -->
            <div class="p-4 md:p-5 space-y-4 max-h-[80vh] overflow-y-auto">
                <form action="{{ route('Book-Class') }}" method="POST" onsubmit="bookClass(event, 'booking-class', '{{ $classId }}')" id="booking-class-{{ $classId }}">
                    @csrf

                    <div class="mb-3">
                        <div class="text-sm font-medium text-gray-900 ms-3">Class: <span id="class-name-{{ $classId }}"></span></div>
                    </div>

                    <div class="mb-3">
                        <div class="text-sm font-medium text-gray-900 ms-3">Day: <span id="day-schedule-{{ $classId }}"></span></div>
                    </div>

                    <div class="mb-3">
                        <div class="text-sm font-medium text-gray-900 ms-3">Start: <span id="start-time-schedule-{{ $classId }}"></span></div>
                    </div>

                    <div class="mb-3">
                        <x-input-default name="Title_{{ $classId }}" placeholder="Input title here" type="text"></x-input-default>
                    </div>

                    <div class="mb-3">
                        <div class="text-sm font-medium text-gray-900 ms-3">Total Hour <span class="text-xs text-gray-400" id="preview-total_hour-{{ $classId }}"></span></div>
                        <input type="number" name="total_hour" id="input-total_hour-{{ $classId }}" min="0" class="block w-full p-3 rounded-full bg-white border border-gray-300 text-sm text-gray-900  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="mb-3">
                        <div class="block mb-1 text-sm font-medium text-gray-900 ms-3">Select Date</div>
                        <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r" id="radio-input-this-week">
                                <div class="flex items-center ps-3">
                                    <input id="this-week" type="radio" value="1" checked name="list-radio-{{ $classId }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="this-week" class="w-full py-3 ms-2 text-sm text-gray-700">For This Week </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="next-week" type="radio" value="2" name="list-radio-{{ $classId }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="next-week" class="w-full py-3 ms-2 text-sm text-gray-700">For Next Week</label>
                                </div>
                            </li>
                            {{-- <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                <div class="flex items-center ps-3">
                                    <input id="week-ahead" type="radio" value="3" name="list-radio-{{ $classId }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                    <label for="week-ahead" class="w-full py-3 ms-2 text-sm text-gray-700">For 2 Weeks Ahead</label>
                                </div>
                            </li> --}}
                        </ul>
                    </div>

                    <div class="mb-3">
                        <label for="description-{{ $classId }}" class="block mb-1 text-sm font-medium text-gray-900 ms-3">Short Description (optional)</label>
                        <textarea name="description" id="description-{{ $classId }}" cols="30" rows="5" class="block w-full p-3 bg-white border border-gray-300 text-sm text-gray-900 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                    </div>

                    <x-button-default type="submit" name="booking-class" text="Submit"></x-button-default>
                </form>
            </div>
        </div>
    </div>
</div>
