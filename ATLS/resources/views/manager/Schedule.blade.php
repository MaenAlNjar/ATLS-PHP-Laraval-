@extends('layouts.app')

@section('title') Schedule @endsection


@section('content')
<div class="bg-gray-200 px-4 py-2 rounded-lg mt-10 font-bold text-xl">
    Class Schedules    </div>
    @foreach ($schedules as $schedule)
        <div class="mb-6 mt-10">
            <div class=" flex gap-10">
                <h2 class=" font-bold">Class name: {{ $schedule->Clase->name }}</h2>
                <h2 class=" font-bold">Class grade: {{ $schedule->Clase->grade }}</h2>
            </div>
           
            <table class="w-full border-collapse border border-gray-500 mt-10 rounded-xl">
                <thead>
                    <tr>
                        <th class="border border-gray-500 px-4 py-2"></th>
                        @for ($i = 1; $i <= 5; $i++)
                            <th class="border border-gray-500 px-4 py-2">{{ $i }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @for ($time = 8; $time <= 15; $time++)
                        <tr class="border border-gray-500">
                            <td class="border border-gray-500 px-4 py-2">{{ $time }}:00</td>
                            @foreach (json_decode($schedule->day) as $day)
                                @foreach ($day as $index => $lesson)
                                    @if ($lesson->time == $time)
                                        <td class="border border-gray-500 px-4 py-2">{{ $lesson->subject }}</td>
                                    @endif
                                @endforeach
                            @endforeach
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    @endforeach
@endsection