@extends('layouts.app')

@section('title') Main page @endsection


@section('content')
<div class="bg-gray-200 px-4 py-2 rounded-lg mt-10 font-bold text-xl">
    Mark
</div>
<div class="overflow-x-auto mt-6">
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Subject Name</th>
                <th class="border border-gray-300 px-4 py-2">Mark 1</th>
                <th class="border border-gray-300 px-4 py-2">Mark 2</th>
                <th class="border border-gray-300 px-4 py-2">Mark 3</th>
            </tr>
        </thead>
        <tbody>
            @foreach($StudentMarks as $StudentMark)
            <tr>
                <td class="border border-gray-300 px-4 py-2">
                    @if($StudentMark->studyMaterial)
                        {{ $StudentMark->studyMaterial->subject_name }}
                    @else
                        <span class="text-red-500">Study Material Not Available</span>
                    @endif
                </td>
                <td class="border border-gray-300 px-4 py-2">{{ $StudentMark->mark_one }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $StudentMark->mark_two }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $StudentMark->mark_final }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
