@extends('layouts.app')

@section('title') Main page @endsection


@section('content')
<div class="bg-gray-200 px-4 py-2 rounded-lg">
    School Class       
    </div>
<div>
    <table class=" border-collapse border border-gray-300 w-fit">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Grade</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classe as $class)
            @if($class->class_stage ==$user->class_stage )
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $class->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $class->grade }}</td>
                <td class="border border-gray-300  flex justify-center gap-10">
                    <a href="{{url('/view/'.$class->id.'/class')}}" class="border px-4 py-2 ">View</a>
                    <a href="{{url('/Schedule/'.$class->id.'/view')}}" class="border px-4 py-2 ">Schedule</a>
                </td>

            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    
</div>
<div class="bg-gray-200 px-4 py-2 rounded-lg mt-10 font-bold text-xl">
    Class Schedules
</div>

@foreach ($schedules as $schedule)
@if($schedule->Clase->class_stage == $user->class_stage)
  <div class="mb-6 mt-10">
        <div class="flex gap-10">
            <h2 class="font-bold">Class name: {{ $schedule->Clase->name }}</h2>
            <h2 class="font-bold">Class grade: {{ $schedule->Clase->grade }}</h2>
        </div>

        <table class="w-full border-collapse border border-gray-500 mt-10 rounded-xl">
            <thead>
                <tr>
                    <th class="border border-gray-500 px-4 py-2 bg-gray-300 text-gray-800 font-bold">Time</th>
                    @for ($i = 1; $i <= 5; $i++)
                        <th class="border border-gray-500 px-4 py-2 bg-gray-300 text-gray-800 font-bold">{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @for ($time = 8; $time <= 15; $time++)
                    <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                        <td class="border border-gray-500 px-4 py-2 text-center">{{ $time }}:00</td>
                        @foreach (json_decode($schedule->day) as $day)
                            @foreach ($day as $index => $lesson)
                                @if ($lesson->time == $time)
                                    @if($lesson->subject == $user->subject)
                                <td class="border border-gray-500 px-4 py-2 text-center">{{ $lesson->subject }}</td>
                                @else <td class="border border-gray-500 px-4 py-2 text-center"></td>
                                @endif
                                @endif
                            @endforeach
                        @endforeach
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    @endif

@endforeach


@endsection
