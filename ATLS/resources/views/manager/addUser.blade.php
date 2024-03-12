@extends('layouts.app')

@section('title') Create class @endsection


@section('content')
<div>
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
{{--Teacher area--}}

    <div class="bg-gray-200 px-4 py-2 rounded-lg mt-10">
        Add Teacher       
        </div>
        <form method="POST" action="{{route('createUser')}}" class="  flex gap-10">
            @csrf
            @method('POST')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter name">
            </div>
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="username" id="username" name="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter address">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter email">
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="teacher">Teacher</option>
                </select>
            </div>
            <div class="mb-4 mt-4">
                <input type="hidden" name="school_id" value="{{Auth::user()->school_id}}">
                <button type="submit" class="inline-flex justify-center  w-32 h-12 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </form>

    <div>
        <div class="bg-gray-200 px-4 py-2 rounded-lg">
            Add user       
            </div>
        <form method="POST" action="{{route('updateSubject')}}" class="flex gap-10">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <select id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($users as $user)
                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="subject_name" class="block text-sm font-medium text-gray-700">Subject Name</label>
                <select id="subject_name" name="subject_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($StudyMaterials as $StudyMaterial)
                        <option value="{{ $StudyMaterial->subject_name }}">{{ $StudyMaterial->subject_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 mt-4">
                <button type="submit" class="inline-flex justify-center  w-32 h-12 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div> 
        </form>
    </div>
{{--Student area--}}
    <div class="bg-gray-200 px-4 py-2 rounded-lg mt-10">
        Add Student       
        </div>
        <form method="POST" action="{{route('createUser')}}" class="  flex gap-10">
            @csrf
            @method('POST')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter name">
            </div>
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="username" id="username" name="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter address">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter email">
            </div>
            <div class="mb-4">
                <label for="class" class="block text-sm font-medium text-gray-700">Class</label>
                <select id="class" name="class" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($classe as $clas)
                    <option value="{{ $clas->id }}">-{{ $clas->name }}-{{ $clas->grade }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 mt-4">
                <input type="hidden" name="role" value="Student">
                <input type="hidden" name="school_id" value="{{Auth::user()->school_id}}">
                <button type="submit" class="inline-flex justify-center  w-32 h-12 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </form>
        <div class="bg-gray-200 px-4 py-2 rounded-lg mt-10">
            Add Student  to class      
            </div>
            <form method="POST" action="{{ route('updateUserClass') }}" class="flex gap-10">
                @csrf
            
                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Student Name</label>
                    <select id="user_id" name="user_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($userz as $user)
                        <option value="{{ $user->id }}">-{{ $user->name }}-{{ $user->grade }}</option>
                        @endforeach
                    </select>
                </div>
               
                <div class="mb-4">
                    <label for="class" class="block text-sm font-medium text-gray-700">Class</label>
                    <select id="class" name="class" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($classe as $clas)
                        <option value="{{ $clas->id }}">-{{ $clas->name }}-{{ $clas->grade }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4 mt-4">
                    <button type="submit" class="inline-flex justify-center  w-32 h-12 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit
                    </button>
                </div>
            </form>
</div>
@endsection
