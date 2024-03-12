@extends('layouts.app')

@section('title') Edit @endsection

@section('content')
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
    <form method="POST" action="{{route('update',$school->id)}}" class="">
        @csrf
        @method('PUT')
        <div class="flex gap-96 bg-white p-6 rounded-md shadow-md">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input name="name" id="name" type="name" value="{{ $school->name }}" class="form-input rounded-md border-gray-300 w-full focus:border-indigo-500" >
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                <textarea name="address" id="address" class="form-textarea rounded-md border-gray-300 w-full focus:border-indigo-500" rows="3">{{ $school->address}}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
        </div>
    </form>

@endsection