@extends('layouts.app')

@section('title') View school  @endsection

@section('content')
<div class="w-30 mx-auto mt-4">
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
    <form method="POST" action="{{route('createUser')}}" class="  flex gap-10">
        @csrf
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
                <option value="manager">Manager</option>
                <option value="teacher">Teacher</option>
            </select>
        </div>
        <div class="mb-4 mt-4">
            <input type="hidden" name="school_id" value="{{$school->id }}">
            <button type="submit" class="inline-flex justify-center  w-32 h-12 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </div>
    </form>
    <div class="bg-white rounded-lg shadow-lg overflow-hidden py-2">
        <div class="bg-gray-200 px-4 py-2">
            School Info
        </div>
        <div class="p-4 flex  justify-center gap-10">
            <h5 class="text-xl font-bold mb-2">School Name: {{ $school->name }}.</h5>
            <p class="text-xl font-bold mb-2">Address:{{ $school->address}}.</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden mt-4">
        <div class="bg-gray-200 px-4 py-2">
        School users info       
        </div>
        <div class="p-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Role</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->role }}</td>
                        <td class="border border-gray-300  flex gap-10">
                            <form style="display: inline;" class="border px-4 py-2" method="POST" action="{{route('destroy',$user->id)}}">
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
    </div>
   
    
</div>
@endsection