@extends('layouts.app')

@section('title') Main page @endsection

@section('content')

<div class="text-center p-10">
    <form method="POST" action="{{ url('/create') }}">
        @csrf
        <button type="submit" class="border py-4 px-2 bg-slate-500 rounded-lg">
            Add school
        </button>
    </form>
</div>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">School Name</th>
                    <th class="px-4 py-2">Adrees Name</th>
                    <th class="px-4 py-2">author</th>
                    <th class="px-4 py-2">action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($schools as $school)
                    <tr class="@if($loop->even) bg-gray-100 @endif">
                        <td class="border px-4 py-2">{{ $school['id'] }}</td>
                        <td class="border px-4 py-2">{{ $school['name'] }}</td>
                        <td class="border px-4 py-2">{{ $school['address'] }}</td>
                        <td class="border px-4 py-2">{{ $school['created_by'] }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ url('/GM/' . $school->id . '/view') }}" class="border px-4 py-2">View</a>
                            <a href="{{ url('/edite/' . $school->id . '/school') }}" class="border px-4 py-2">Edit</a>
                            <form style="display: inline;" class="border px-4 py-2" method="POST" action="{{route('delete',$school->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bordre px-4 py-2">Delete</button>
                            </form> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
