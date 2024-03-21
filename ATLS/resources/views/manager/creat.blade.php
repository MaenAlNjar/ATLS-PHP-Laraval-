@extends('layouts.app')

@section('title') Create class @endsection


@section('content')
<div class=" mx-auto mt-4">
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{session('error')}}    
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
    </div>
    @endif
    <div class="bg-gray-200 px-4 py-2 rounded-lg">
        Add class       
        </div>
        <div class="flex gap-10">
            <form class="mt-10 mb-10" method="POST" action="{{ route('generateSchedules', 'Primary education') }}">
                @csrf
                <button type="submit" class="btn-indigo">Generate Schedules Primary</button>
            </form>
            <form class="mt-10 mb-10" method="POST" action="{{ route('generateSchedules', 'Secondary education') }}">
                @csrf
                <button type="submit" class="btn-indigo">Generate Schedules Secondary</button>
            </form>
            <form class="mt-10 mb-10" method="POST" action="{{ route('generateSchedules', 'High school') }}">
                @csrf
                <button type="submit" class="btn-indigo">Generate Schedules High School</button>
            </form>
        </div>
    <div class="bg-gray-200 px-4 py-2 rounded-lg">
        Add class       
        </div>
        <form method="POST" action="{{ route('addClass') }}" class="flex gap-10">
            @csrf
        
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <select id="name" name="name" class="form-input">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
        
            <div class="mb-4">
                <label for="grade" class="block text-sm font-medium text-gray-700">Grade</label>
                <select id="grade" name="grade" class="form-input">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>

                </select>
            </div>
        
            <div class="mb-4 mt-4">
                <input type="hidden" name="school_id" value="{{ Auth::user()->school_id }}">
                <button type="submit" class="btn-indigo">
                    Submit
                </button>
            </div>
        </form>
        <div class="bg-gray-200 px-4 py-2 rounded-lg">
            School Class       
            </div>
        <div>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Grade</th>
                        <th class="border border-gray-300 px-4 py-2">levl</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classe as $class)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $class->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $class->grade }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $class->class_stage }}</td>
                        <td class="border border-gray-300  flex justify-center gap-10">
                            <a href="{{url('/view/'.$class->id.'/class')}}" class="border px-4 py-2 ">View</a>
                            <a href="{{route('ClassSchedule',$class->id)}}" class="border px-4 py-2 ">Schedule</a>

                            <form  class="border px-4 py-2" method="POST" action="{{route('destroyClass',$class->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="">Delete</button>
                            </form> 
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection
