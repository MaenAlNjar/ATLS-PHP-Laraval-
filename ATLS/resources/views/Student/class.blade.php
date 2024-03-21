@extends('layouts.app')

@section('title') Class @endsection


@section('content')
<div class="bg-gray-200 px-4 py-2 rounded-lg mt-10">
    Class Students
</div>
<div class="mt-4 overflow-x-auto">
    <table class="border-collapse border border-gray-300 w-full">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2 text-left">Student Name</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Mark</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    @if($user->id == Auth::user()->id)
                    <a href="{{ route('StudentMark',$user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        View
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
